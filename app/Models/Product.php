<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['barcode', 'description', 'company_id'];

    protected $casts = [
        'expiration_dates' => 'array',
    ];

    public function toArray()
    {
        $array = [
            'id' => $this->id,
            'barcode' => $this->barcode,
            'description' => $this->description,
            'expiration_dates' => $this->expiration_dates,
            'company_id' => $this->company_id,
        ];

        return $array;
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function expirationDates()
    {
        return $this->hasMany(ExpirationDate::class, 'product_id', 'id')->orderBy('date');
    }
}