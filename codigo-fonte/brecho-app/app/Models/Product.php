<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'category_id',
        'image',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function shoppingCarts()
    {
        return $this->hasMany(ShoppingCart::class);
    }

    public function productInCart($user_id)
    {
        return ShoppingCart::where('user_id', $user_id)->where('product_id', $this->id)->first();
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(UserBookmarks::class);
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class)->orderBy('created_at', 'desc');
    }

    public function averageRating()
    {
        return round($this->reviews()->avg('rating') ?? 0, 2);
    }
}
