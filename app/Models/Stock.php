<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Stock extends Model
{
    use HasFactory;

    protected $table = "stock";

    protected $casts = [
        'in_stock' => 'boolean'
    ];

    public function track()
    {
        // hit the api endpoint for the associated retailer
        if($this->retailer->name === 'Best buy') {
            $results = Http::get('http://foo.test')->json();

            $this->update([
                'in_stock' => $results['available'],
                'price' => $results['price']
            ]);
        }
        // fetch the up to date details for the item
        // and refresh the current stock record.
    }

    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }
}
