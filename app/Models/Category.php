<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    public static $page = 5;

    protected $fillable = ['name', 'send_to', 'company_id'];

    protected $casts = ['send_to' => 'array'];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function products(){
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
