<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class history_of_transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'depositor_id',
        'officer_id',
        'status_id',
        'level_id',
        'remarks'
    ];
    protected $table = 'history_of_transactions';
}
