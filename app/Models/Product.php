<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['barcode', 'description', 'company_id', 'category_id'];

    public function toArray()
    {
        $array = [
            'id' => $this->id,
            'barcode' => $this->barcode,
            'description' => $this->description,
            'expiration_dates' => $this->expirationDates,
            'company_id' => $this->company_id,
        ];

        return $array;
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id')->withTrashed();
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id')->withTrashed();
    }

    public function expirationDates()
    {
        return $this->hasMany(ExpirationDate::class, 'product_id', 'id')->orderBy('date');
    }

    public function totalAmount()
    {
        return ExpirationDate::where('product_id', '=', $this->id)
                             ->where('deleted_at', '=', null)
                             ->sum('amount');
    }
}