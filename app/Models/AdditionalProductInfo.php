<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AdditionalProductInfo
 *
 * @property int $id
 * @property int $product_id
 * @property string|null $notes
 * @property string|null $overview
 * @property string|null $payment
 * @property string $warranty
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalProductInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalProductInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalProductInfo query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalProductInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalProductInfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalProductInfo whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalProductInfo whereOverview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalProductInfo wherePayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalProductInfo whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalProductInfo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalProductInfo whereWarranty($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Product $product
 */
class AdditionalProductInfo extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * infos for a product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
