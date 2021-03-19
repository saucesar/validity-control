<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Auth\MustVerifyEmail as AuthMustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject, MustVerifyEmail
{
    use HasFactory, Notifiable, AuthMustVerifyEmail, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'company_id',
        'access_granted',
        'access_denied',
        'role',
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

    public function getProducts(string $orderBy = 'description')
    {
        return $this->access_granted ? $this->queryProducts($orderBy)->paginate($this->perPage) : null;
    }

    public function getProductsWithoutPaginate()
    {
        return $this->access_granted ? $this->queryProducts()->get() : null;
    }


    private function queryProducts(string $orderBy = 'description')
    {
        if($orderBy == 'expiration_dates.date') {
            return Product::ByExpirationDate($this->company_id, Carbon::now(), Carbon::now()->addDays(30));
        } else {
            return Product::where('company_id', $this->company->id)->orderBy($orderBy);
        }
    }

    public function queryProductsByExpDate($days)
    {
        $initialDate = Carbon::now();
        $finalDate = Carbon::now()->addDays($days);
        
        return Product::ByExpirationDate($this->company_id, $initialDate, $finalDate);
    }

    public function usersGranted()
    {

        $users = User::where('company_id', $this->company_id)
                   ->where('access_granted', true)
                   ->where('id', '<>', $this->id)
                   ->get();
        return count($users) > 0 ? $users : null;
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

        $requests = User::where('company_id', $this->company_id)
                        ->where('access_granted', false)
                        ->where('access_denied', false);
        
        return $requests->exists() ? $requests->get() : null;
    }

    public function makeRoadMap(int $days = 30, int $perPage = 5)
    {
        $initialDate = Carbon::now();
        $finalDate = Carbon::now()->addDays($days);
        
        $expdates = ExpirationDate::roadMap($this->company_id, $initialDate, $finalDate);
        if($perPage > 0) {
            return $expdates->paginate($perPage);
        } else {
            return $expdates->get();
        }
    }
}