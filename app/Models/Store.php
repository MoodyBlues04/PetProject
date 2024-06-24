<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property ?string $description
 *
 * @property Collection $products
 */
class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'description',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'store_id');
    }
}
