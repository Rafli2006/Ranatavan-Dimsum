<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'variant_id',
        'name',
        'description',
        'price',
        'cost_price',
        'stock',
        'image',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'cost_price' => 'decimal:2',
            'stock' => 'integer',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }

    public function sizes()
    {
        return $this->hasMany(ProductSize::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function stockHistories()
    {
        return $this->hasMany(StockHistory::class);
    }
}
