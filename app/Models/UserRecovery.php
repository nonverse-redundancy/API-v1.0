<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRecovery extends Model
{

    protected $connection = 'core';
    protected $table = 'user_recovery';

    use HasFactory;
}
