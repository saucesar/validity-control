<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmountInOut extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'type', 'reason', 'exp_date_id', 'user_id'];

    public function expirationDate()
    {
        return $this->belongsTo(ExpirationDate::class, 'exp_date_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
