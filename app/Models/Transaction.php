<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Transaction extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'transactions';
    protected $fillable =[
        'depositor_id',
        'status_id', 
        'level_id',
        'officer_id',
        'uploaded_receipt', 
        'remarks',

    ];
    
   
}
