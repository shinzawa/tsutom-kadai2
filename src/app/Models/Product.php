<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'image', 'description'];

    public function seasons()
    {
        return $this->belognsToMany(Season::class,'product_id', 'season_id');
    }

    public function scopeNameSearch($query, $name)
    {
        $query->where('name', 'like', $name);
    }
}
