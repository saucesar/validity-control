<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpirationDate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['date', 'amount', 'lote', 'product_id'];

    public function toArray()
    {
        return [
            'date' => $this->date,
            'amount' => $this->amount,
            'lote' => $this->lote,
            'product_id' => $this->product_id,
        ];
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id')->withTrashed();
    }

    public function daysToExpire()
    {
        return Carbon::parse($this->date)->diffInDays(Carbon::now());
    }

    public function statusClass()
    {
        if($this->daysToExpire() >= 30){ return 'bg-green'; }
        else if($this->daysToExpire() >= 20){ return 'bg-light-green'; }
        else if($this->daysToExpire() >= 10){ return 'bg-orange'; }
        else { return 'bg-red'; }
    }

    public static function byDays($company_id, $days = 3)
    {
        return ExpirationDate::join('products', 'products.id', '=', 'expiration_dates.product_id')
                             ->where('products.company_id', $company_id)
                             ->whereBetween('expiration_dates.date', [Carbon::now(), Carbon::now()->addDays($days)])
                             ->distinct(['products.id'])
                             ->select('expiration_dates.*')
                             ->get();
    }
}
