<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Retailer
 *
 * @method static \Database\Factories\RetailerFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Retailer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Retailer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Retailer query()
 * @mixin \Eloquent
 */
class Retailer extends Model
{
    use HasFactory;

    public function addStock(Product $product, Stock $stock)
    {
        $stock->product_id = $product->id;
        $this->stock()->save($stock); // retailer_id, product_id
    }

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }
}
