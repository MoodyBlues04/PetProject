<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $store_id
 * @property string $name
 * @property int $price
 * @property string $description
 *
 * @property Store $store
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'store_id',
        'price',
        'description',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}
