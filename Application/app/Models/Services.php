<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $table = 'services';

    public $timestamps = true;

    /**
     * List of supported curerncies
     */
    private array $currencies = [
        'ron' => 'RON',
        'eur' => '€',
        'usd' => '$',
        'gbp' => '£',
    ];

    public function getCurrencies(): array
    {   
        if (empty($this->currencies)) {
            return [];
        }
        
        return $this->currencies;
    }

    public function getCurrencySymbol(): string
    {
        if (empty($this->currencies[$this->currency])) {
            return $this->currency;
        }

        return $this->currencies[$this->currency];
    }
}
