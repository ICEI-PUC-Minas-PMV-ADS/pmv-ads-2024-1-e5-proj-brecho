<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'user_id', 'rating', 'comment'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getRatingAttribute($value)
    {
        return $value . '/5';
    }

    public function setRatingAttribute($value)
    {
        $this->attributes['rating'] = str_replace('/5', '', $value);
    }

    public function getCommentAttribute($value)
    {
        return ucfirst($value);
    }
}
