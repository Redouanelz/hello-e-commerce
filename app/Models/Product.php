<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'stock', 'image_url', 'category_id',
    ];

    // Relationship: A product belongs to a category
    public function category() {
        return $this->belongsTo(Category::class);
    }

    // Relationship: A product belongs to many orders (through OrderItems)
    public function orders() {
        return $this->belongsToMany(Order::class, 'order_items')->withPivot('quantity', 'price');
    }
}
