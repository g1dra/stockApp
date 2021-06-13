<?php

namespace App\Models;


use Facades\App\Clients\ClientFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Stock
 *
 * @property int $id
 * @property int $product_id
 * @property int $retailer_id
 * @property int $price
 * @property string $url
 * @property string|null $sky
 * @property bool $in_stock
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Retailer $retailer
 * @method static \Database\Factories\StockFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock query()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereInStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereRetailerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereSky($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereUrl($value)
 * @mixin \Eloquent
 */
class Stock extends Model
{
    use HasFactory;

    protected $table = "stock";

    protected $casts = [
        'in_stock' => 'boolean'
    ];

    public function track()
    {

        //$status = ClientFactory::make($this->retailer)->checkAvailability($this);

        $status = $this->retailer
            ->client()->checkAvailability($this);

        $this->update([
            'in_stock' => $status->available,
            'price' => $status->price
          ]);
    }

    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }

}
