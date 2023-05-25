<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["name", "email", "password", "firstName", "lastName", "phone", "country", "city", "address", "address2", "zipCode", "state", "role", "avatar"];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ["password", "remember_token"];

    public function isManager(): bool
    {
        return $this->role === "manager";
    }

    public function isAdmin(): bool
    {
        return $this->role === "admin";
    }

    public function canAccessFilament(): bool
    {
        return $this->isManager() || $this->isAdmin();
    }

    public function orders()
    {
        return $this->hasMany(Order::class, "userId");
    }
}
