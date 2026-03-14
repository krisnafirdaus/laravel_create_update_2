<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
    ];

    protected $casts = [
        'price' => 'integer',
        'stock' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $appends = [
        'formatted_price'// snaka case
    ];


    // get{NamaAttribute}Attribute()
    // Nama Attribut = FormattedPrice = formatted_price
    // $product->formatted_price

    // Product Model
    //  ↓
    // cek $appends
    //     ↓
    // formatted_price
    //     ↓
    // Laravel cari method:
    // getFormattedPriceAttribute()
    //     ↓
    // jalankan function
    //     ↓
    // hasil dimasukkan ke JSON'

    // {
    //     "id": 1,
    //     "name": "Laptop",
    //     "description": "Gaming laptop",
    //     "price": 15000000,
    //     "stock": 5,
    //     "formatted_price": "Rp 15.000.000"
    // }

    public function getFormattedPriceAttribute(): string // accessor harus camel case
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }
}
