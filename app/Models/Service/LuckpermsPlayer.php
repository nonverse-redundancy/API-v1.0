<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LuckpermsPlayer extends Model
{
    use HasFactory;

    protected $connection = 'luckperms';
    protected $table = 'luckperms_players';
}
