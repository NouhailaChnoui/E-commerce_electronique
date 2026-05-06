<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 'description', 'prix', 'image', 'quantite', 'actif', 'category_id'
    ];

    protected $casts = [
        'actif' => 'boolean',
        'prix' => 'decimal:2'
    ];

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : asset('images/default-product.png');
    }

    protected $appends = ['image_url'];

    public function scopeActive($query)
    {
        return $query->where('actif', true);
    }

    public function scopeInStock($query)
    {
        return $query->where('quantite', '>', 0);
    }

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }
}
