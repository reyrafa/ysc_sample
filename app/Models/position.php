<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class position extends Model
{
    use HasFactory;
    protected $table = 'positions';
    protected $fillable = [
        'officer_id',
        'org_id',
        'position_id',
        'permission_id'
    ];
}
