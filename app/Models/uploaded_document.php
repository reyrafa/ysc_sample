<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class uploaded_document extends Model
{
    use HasFactory;
    protected $table = 'uploaded_documents';
    protected $fillable =[
        'depositor_id',
        'Signature',
        'Identification',
        'birth_certificate'
    ];
}
