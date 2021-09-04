<?php

namespace App\Models\Service\Panel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanelUser extends Model
{
    use HasFactory;

    protected $connection = 'panel';
    protected $table = 'users';
}
