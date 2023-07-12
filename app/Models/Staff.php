<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Staff extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;


    protected $fillable = [
        'name',
        'email',
        'password',
        "phone",
        "role",
    ];

    // Implement the required methods from Authenticatable
    public function getAuthIdentifierName() {
        return 'id';
    }

    public function getAuthIdentifier() {
        return $this->getKey();
    }

    public function getAuthPassword() {
        // Return the password field of the technician model
        return $this->password;
    }

    public function getRememberToken() {
        return null; // Not using remember token
    }

    public function setRememberToken($value) {
        // Not using remember token
    }

    public function getRememberTokenName() {
        return null; // Not using remember token
    }
}
