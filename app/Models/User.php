<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Auth\MustVerifyEmail as AuthMustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject, MustVerifyEmail
{
    use HasFactory, Notifiable, AuthMustVerifyEmail;

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

    protected $perPage = 5;

    public function toArray()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'company' => $this->company->name,
            'access_granted' => $this->access_granted,
            'access_denied' => $this->access_denied,
        ];
    }
    
    public function firstName()
    {
        return explode(' ', $this->name)[0];
    }
    
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
        ];
    }

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
        return $this->access_granted ? $this->queryProducts()->paginate($this->perPage) : null;
    }

    public function getProductsWithoutPaginate()
    {
        return $this->access_granted ? $this->queryProducts()->get() : null;
    }


    private function queryProducts()
    {
        return Product::where('company_id', $this->company->id)->orderBy('description');
    }

    public function queryProductsByExpDate($days)
    {
        $initial_date = Carbon::now();
        $final_date = Carbon::now()->addDays($days);
        
        return Product::where('company_id', $this->company->id)
                      ->join('expiration_dates', 'expiration_dates.product_id', '=', 'products.id')
                      ->whereBetween('expiration_dates.date', [$initial_date, $final_date])
                      ->where('expiration_dates.deleted_at', '=', null)
                      ->distinct(['products.id'])
                      ->select('products.*');

    }

    public function usersGranted()
    {
        return User::where('company_id', $this->company->id)
                   ->where('access_granted', true)
                   ->where('id', '<>', $this->id)
                   ->get();
    }

    public function productsByExpiration($days)
    {
        return $this->access_granted ? $this->queryProductsByExpDate($days)->paginate($this->perPage)
                                     : null;
    }

    public function productsByExpirationNoPage($days=30)
    {
        return $this->queryProductsByExpDate($days)->get();
    }

    public function accessRequests()
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