<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['barcode', 'description', 'company_id', 'category_id'];

    public static $page = 5;

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

    public static function ByExpirationDate($companyId, $initialDate, $finalDate)
    {
        return Product::where('company_id', $companyId)
                      ->join('expiration_dates', 'expiration_dates.product_id', '=', 'products.id')
                      ->whereBetween('expiration_dates.date', [$initialDate, $finalDate])
                      ->where('expiration_dates.deleted_at', '=', null)
                      ->distinct(['products.id'])
                      ->orderBy('products.id')
                      ->orderBy('expiration_dates.date')
                      ->select('products.*');
    }
}