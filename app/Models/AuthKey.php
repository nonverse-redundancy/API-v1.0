<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthKey extends Model
{
    protected $connection = "services";
    protected $table = "authme";
    use HasFactory;
}
