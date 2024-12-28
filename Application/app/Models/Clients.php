<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Clients extends Model
{
    use HasFactory;

    protected $table = 'clients';

    /**
     * Function to get all invoices of a client
     * 
     * @param int $limitPerPage
     * @return array
     */
    public function getInvoices(int $limitPerPage)
    {
        return $this->hasMany(Invoices::class, 'client_id', 'id')->orderBy('created_at', 'DESC')->paginate($limitPerPage);
    }
}
