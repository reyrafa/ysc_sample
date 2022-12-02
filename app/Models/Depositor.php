<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depositor extends Model
{
    
    protected $fillable = [
        'depositor_id',
        'firstname',
        'lastname',
        'middlename',
        'suffix',
        'date_of_birth',
        'gender',
        'home_address',
        'contact_no',
        'branch_id',
        'branch_under_id'
    ];
    protected $table = 'depositors';
}
