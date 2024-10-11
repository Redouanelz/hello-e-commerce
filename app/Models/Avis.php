<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    use HasFactory;

    // Specify the table if it's not plural form
    protected $table = 'avis';

    // Specify the fillable fields to protect against mass assignment
    protected $fillable = [
        'description',
        'note',
        'id_product'
    ];

    /**
     * Define a relationship to the Product model.
     * Assuming the foreign key is 'id_product' and it references the 'products' table.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}
