<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\Client as PassportClient;

class Merchant extends PassportClient
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'merchant';
}
