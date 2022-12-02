<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficialMember extends Model
{
    use HasFactory;
    protected $table = 'official_members';
    protected $fillable =[
        'depositor_id',
        'isAlumni'
    ];
}
