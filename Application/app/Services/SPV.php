<?php

namespace App\Services;

use App\Http\Controllers\Anaf\AnafOAuthController;
use App\Models\Invoices;

class SPV
{
    private int $invoiceId;
    private ?InvoiceToXml $invoiceToXml = null;
    private ?AnafOAuthController $anafOAuthController = null;
    private ?Invoices $invoice = null;

    public function __construct(int $invoiceId)
    {
        $this->invoiceId = $invoiceId;
        $this->invoiceToXml = new InvoiceToXml();

        $this->anafOAuthController = new AnafOAuthController();
        
        $this->invoice = Invoices::find($invoiceId);
    }

    /**
     * Generate the XML content for the invoice.
     * 
     * @return void
     */
    public function generateXml(): void
    {
        $this->invoiceToXml->generateInvoiceData($this->invoiceId);

        $this->invoiceToXml->convert();
    }

    /**
     * Get the XML content.
     * 
     * @return string
     */
    public function getXml(): string
    {
        return $this->invoiceToXml->getXml();
    }

    /**
     * Send the XML content to ANAF - SPV using the API and OAuth.
     * 
     * @return bool - True if the XML was sent successfully, false otherwise.
     */
    public function sendXmlToSPV(): bool
    {
        $this->anafOAuthController->authorize();

        if(!cache()->has('oauth2token'))
        {
            return false;
        }

        $xml = $this->getXml();

        // Send the XML to ANAF - SPV
        return $this->uploadXmlToSPV($xml);
    }

    /**
     * Upload the XML content to ANAF - SPV using the API
     * 
     * @param string $xml - The XML content
     * 
     * @return bool
     */
    private function uploadXmlToSPV(string $xml): bool
    {
        if(blank($this->invoice))
        {
            return false;
        }

        $upload_url = config('spv.url.upload');

        // Replace the placeholders in the URL
        $upload_url = str_replace('{standard}', 'UBL', $upload_url);
        $upload_url = str_replace('{cif}', $this->invoice->getClientDetails()->cui, $upload_url);

        $upload_url = str_replace('{extern}', '', $upload_url);
        if($this->invoice->getClientDetails()->country !== 'Romania')
        {
            $upload_url = str_replace('{extern}', 'DA', $upload_url);
        }
        
        // Initialize POST request
        $ch = curl_init($upload_url);

        // Set the POST request options
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/xml',
            'Authorization: Bearer ' . cache()->get('oauth2token')->getToken(),
        ]);
        
        // Execute the POST request
        $result = curl_exec($ch);

        cache()->put('invoice-spv-return-' . $this->invoiceId, $result, 60 * 60 * 24); // Store the result for 24 hours

        // Check if the request was successful
        if($result === false)
        {
            return false;
        }

        return true;
    }
}