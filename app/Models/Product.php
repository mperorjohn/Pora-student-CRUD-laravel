<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock_quantity',
        'brand_id',
        'is_active',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Relationship
    public function brand()
    {
        return $this->belongsTo(Brand::class)->select('id', 'name', 'logo_url');
    }

    public function scopeIsActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeWithBrand($query)
    {
        return $query->with('brand:id,name,logo_url');
    }


}
