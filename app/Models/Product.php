<?php

namespace App\Models;

use App\Traits\Mediable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $title
 * @property int $hashrate
 * @property string $hashrate_unit
 * @property int|null $weight
 * @property int|null $price
 * @property int $in_store_count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereHashrate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereHashrateUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereWeight($value)
 * @mixin \Eloquent
 * @property-read \App\Models\AdditionalProductInfo|null $info
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereInStoreCount($value)
 * @property mixed $image
 * @property-read mixed $preview
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 */
class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use Mediable {
        Mediable::registerMediaConversions insteadof InteractsWithMedia;
    }

    protected $guarded = ['id'];

    protected $hidden = ['created_at', 'updated_at'];

    protected $perPage = 6;

    /**
     * additional info about product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function info()
    {
        return $this->hasOne(AdditionalProductInfo::class);
    }
}
