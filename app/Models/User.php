<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    CONST VERIFIED_USER = '1';
    CONST UNVERIFIED_USER = '0';
    
    CONST ADMIN_USER = 'true';
    CONST REGULAR_USER = 'false';

    protected $fillable = [
        'name',
        'email',
        'password',
        'verified',
        'verification_token',
        'admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'verification_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isAdmin(): bool
    {
        return $this->admin === User::ADMIN_USER;
    }

    public function isVerified(): bool
    {
        return $this->verified === User::VERIFIED_USER;
    }

    public static function generateVerificationCode(): string
    {
        return Str::random(40);
    }
}
