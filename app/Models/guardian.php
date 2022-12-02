<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class guardian extends Model
{
    use HasFactory;
    protected $fillable = [
        'depositor_id',
        'guardian_firstname',
        'guardian_lastname',
        'guardian_middlename',
        'guardian_suffix',
        'guardian_date_of_birth',
        'guardian_gender',
        'guardian_relationship_to_depositor',
        'guardian_civil_status',
        'guardian_oic_member',
        'guardian_home_address',
        'guardian_present_address',
        'guardian_contact_no',
    ];

    protected $table = 'guardians';
}
