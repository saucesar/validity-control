<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'owner_id'];

    public function products()
    {
        return $this->hasMany(Product::class, 'company_id', 'id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'products' => $this->products,
        ];
    }
}