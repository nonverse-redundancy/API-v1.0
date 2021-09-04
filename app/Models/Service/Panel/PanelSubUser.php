<?php

namespace App\Models\Service\Panel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanelSubUser extends Model
{
    use HasFactory;

    protected $connection = 'panel';
    protected $table = 'subusers';
}
