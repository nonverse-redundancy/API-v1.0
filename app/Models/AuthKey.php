<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthKey extends Model
{
    use HasFactory;

    protected $connection = "services";
    protected $table = "authme";

    protected $hidden = [
        'totp',
        'password',
    ];
}
