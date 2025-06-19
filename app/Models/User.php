<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /* Companies */
    public function company(){
        return $this->belongsTo(User::class,'company_id');
    }

    /* Users */
    public function users(){
        return $this->hasMany(User::class,'company_id');
    }

    /* Companies */
    public function scopeCompanies($query){
        return $query->where('role_id', 2);
    }

    /* staff */
    public function scopeCompanyUsers($query){
        return $query->whereIn('role_id',[3,4]);
    }

    /* staff */
    public function scopeStaff($query){
        return $query->where('role_id', 3);
    }

    /* technician */
    public function scopeTechnician($query){
        return $query->where('role_id', 4);
    }

    /* Company ID */
    public function companyId(){
        $company_id = null;
        if (Auth::check()) {
            if (!Auth::user()->company) $company_id = Auth::user()->id;
            else $company_id = Auth::user()->company_id;
        }
        return $company_id;
    }
}
