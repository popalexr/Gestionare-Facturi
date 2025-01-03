<?php

namespace App\Services;

use App\Models\Invoices;
use SimpleXMLElement;

class InvoiceToXml
{
    private SimpleXMLElement $xml;
    private array $invoice_data = [];

    public function __construct()
    {
        $this->xml = new SimpleXMLElement('<Invoice xmlns="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2"></Invoice>');
    }

    /**
     * Recursively convert an associative array to XML nodes.
     *
     * @param array $data The array to convert.
     * @param SimpleXMLElement $xmlData The SimpleXMLElement object to append nodes to.
     *
     * @return void
     */
    private function arrayToXml(array $data, SimpleXMLElement $xmlData): void
    {
        foreach ($data as $key => $value) {
            // If the key is numeric, prepend a generic item name (e.g. "item")
            if (is_numeric($key)) {
                $key = 'item' . $key;
            }
            
            // If the value is an array, recurse into it
            if (is_array($value)) {
                $subnode = $xmlData->addChild($key);
                $this->arrayToXml($value, $subnode);
            } else {
                // Convert special characters to XML entities
                $xmlData->addChild($key, htmlspecialchars((string) $value));
            }
        }
    }

    /**
     * Function to convert array to XML.
     * 
     * @return void
     */
    public function convert(): void
    {
        $this->arrayToXml($this->invoice_data, $this->xml);
    }

    /**
     * Get the XML content.
     * 
     * @return string
     */
    public function getXml(): string
    {
        return $this->xml->asXML();
    }

    /**
     * Generate the invoice data array.
     * 
     * @param int $invoice_id
     * @return void
     */
    public function generateInvoiceData(int $invoice_id): void
    {
        $invoice = Invoices::find($invoice_id);

        if(blank($invoice)) {
            return;
        }

        $this->invoice_data = [
            'cbc:UBLVersionID' => '2.1',
            'cbc:CustomizationID' => 'urn:cen.eu:en16931:2017#compliant#urn:efactura.mfinante.ro:CIUS-RO:1.0.0',
            'cbc:ID' => $invoice->id,
            'cbc:IssueDate' => $invoice->created_at->format('Y-m-d'),
            'cbc:DueDate' => $invoice->created_at->format('Y-m-d'),
            'cbc:InvoiceTypeCode' => '380',
            'cbc:DocumentCurrencyCode' => currency_symbol($invoice->currency),
            'cac:InvoicePeriod' => [
                'cbc:EndDate' => $invoice->created_at->format('Y-m-d')
            ],
            'cac:AccountingSupplierParty' => [
                'cac:Party' => [
                    'cac:PartyName' => [
                        'cbc:Name' => settings()->get('company_name'),
                    ],
                    'cac:PostalAddress' => [
                        'cbc:StreetName' => settings()->get('company_address'),
                        'cbc:CityName' => settings()->get('company_city'),
                        'cbc:PostalZone' => '12345',
                        'cbc:CountrySubentity' => 'RO-B',
                        'cac:Country' => [
                            'cbc:IdentificationCode' => 'RO'
                        ]
                    ],
                    'cac:PartyTaxScheme' => [
                        'cbc:CompanyID' => settings()->get('company_cui'),
                        'cac:TaxScheme' => [
                            'cbc:ID' => 'VAT',
                        ]
                    ],
                    'cac:PartyLegalEntity' => [
                        'cbc:RegistrationName' => settings()->get('company_name'),
                        'cac:CompanyLegalForm' => settings()->get('company_reg_number'),
                    ],
                    'cac:Contact' => [
                        'cbc:ElectronicMail' => settings()->get('company_email'),
                    ]
                ],
            ],
            'cac:AccountingCustomerParty' => [
                'cac:Party' => [
                    'cac:PartyIdentification' => [
                        'cbc:ID' => $invoice->getClientDetails()->cui,
                    ],
                    'cac:PartyName' => [
                        'cbc:Name' => $invoice->getClientDetails()->name,
                    ],
                    'cac:PostalAddress' => [
                        'cbc:StreetName' => $invoice->getClientDetails()->address,
                        'cbc:CityName' => $invoice->getClientDetails()->city,
                        'cbc:PostalZone' => '54321',
                        'cbc:CountrySubentity' => 'RO-B',
                        'cac:Country' => [
                            'cbc:IdentificationCode' => 'RO'
                        ]
                    ],
                    'cac:PartyTaxScheme' => [
                        'cbc:CompanyID' => $invoice->getClientDetails()->cui,
                        'cac:TaxScheme' => [
                            'cbc:ID' => 'VAT',
                        ]
                    ],
                    'cac:PartyLegalEntity' => [
                        'cbc:RegistrationName' => $invoice->getClientDetails()->name,
                        'cac:CompanyLegalForm' => $invoice->getClientDetails()->client_reg_number ?? '',
                    ],
                    'cac:Contact' => [
                        'cbc:ElectronicMail' => $invoice->client_email ?? '',
                    ]
                ],
            ],
            'cac:PaymentMeans' => [
                'cbc:PaymentMeansCode' => '31',
                'cac:PayeeFinancialAccount' => [
                    'cbc:ID' => $invoice->getClientDetails()->iban ?? '',
                ],
            ],
            'cac:TaxTotal' => [
                'cbc:TaxAmount' => 0,
                // 'cac:TaxSubtotal' => [
                //     'cbc:TaxableAmount' => 0,
                //     'cbc:TaxAmount' => 0,
                //     'cac:TaxCategory' => [
                //         'cbc:ID' => 'S',
                //         'cbc:Percent' => $,
                //         'cac:TaxScheme' => [
                //             'cbc:ID' => 'VAT',
                //         ]
                //     ]
                // ],
            ],
            'cac:LegalMonetaryTotal' => [
                'cbc:LineExtensionAmount' => 0,
                'cbc:TaxExclusiveAmount' => 0,
                'cbc:TaxInclusiveAmount' => $invoice->value,
                'cbc:PayableAmount' => $invoice->value,
            ],
        ];

        $items = $invoice->getProducts();

        foreach ($items as $item)
        {
            $this->invoice_data['cac:InvoiceLine'][] = [
                'cbc:ID' => $item->id,
                'cbc:InvoicedQuantity' => $item->quantity,
                'cbc:LineExtensionAmount' => $item->price,
                'cac:Item' => [
                    'cbc:Name' => $item->product_name,
                    'cac:SellersItemIdentification' => [
                        'cbc:ID' => $item->id,
                    ],
                    'cac:ClassifiedTaxCategory' => [
                        'cbc:ID' => 'S',
                        'cbc:Percent' => $item->vat,
                        'cac:TaxScheme' => [
                            'cbc:ID' => 'VAT',
                        ]
                    ],
                ],
                'cac:Price' => [
                    'cbc:PriceAmount' => CurrencyConverter::convert($item->price, $invoice->currency, 'ron'),
                ],
            ];
        }
    }
}