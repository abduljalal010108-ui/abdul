<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Product extends Model
{
    private const DEFAULT_IMAGES = [
        'nasi-goreng-spesial' => 'images/products/nasi-goreng-spesial.jpg',
        'ayam-geprek' => 'images/products/ayam-geprek.jpg',
        'mie-goreng-jawa' => 'images/products/mie-goreng-jawa.jpg',
        'pisang-cokelat' => 'images/products/pisang-cokelat.jpg',
        'kentang-goreng' => 'images/products/kentang-goreng.jpg',
        'es-teh-manis' => 'images/products/es-teh-manis.jpg',
        'jus-alpukat' => 'images/products/jus-alpukat.jpg',
    ];

    protected $fillable = ['category_id', 'name', 'slug', 'description', 'price', 'stock', 'image', 'is_active'];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    protected $appends = ['image_url'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return isset(self::DEFAULT_IMAGES[$this->slug])
                ? asset(self::DEFAULT_IMAGES[$this->slug])
                : asset('images/placeholder.svg');
        }

        if (Str::startsWith($this->image, ['http://', 'https://'])) return $this->image;
        return Storage::url($this->image);
    }
}
