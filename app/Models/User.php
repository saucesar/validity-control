<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'company_id',
        'access_granted',
        'access_denied',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function company()
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }

    public function isCompanyOwner()
    {
        return ($this->company->owner->id == $this->id);
    }

    public function getProducts()
    {
        return $this->access_granted ? Product::where('company_id', $this->company->id)->orderBy('description')->paginate(15) : null;
    }

    public function getProductsByExpiration($days)
    {
        $initial_date = Carbon::now();
        $final_date = Carbon::now()->addDays($days);

        return $this->access_granted ? Product::where('company_id', $this->company->id)
                                              ->join('expiration_dates', 'expiration_dates.product_id', '=', 'products.id')
                                              ->whereDate('expiration_dates.date', '>=', $initial_date)
                                              ->whereDate('expiration_dates.date', '<=', $final_date)
                                              ->distinct(['products.id'])
                                              ->select('products.*')
                                              ->paginate(15)
                                     : null;
    }

    public function getAccessRequests()
    {
        if(!$this->isCompanyOwner()){
            return null;
        }

        $requests = User::where('company_id', $this->company->id)
                        ->where('access_granted', false)
                        ->where('access_denied', false);
        
        return $requests->exists() ? $requests->get() : null;
    }
}