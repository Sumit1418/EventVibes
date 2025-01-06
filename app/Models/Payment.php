<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $primaryKey = 'transaction_id';

    protected $table = 'payment';

    protected $casts = [
        'transaction_id' => 'string', // Ensure transaction_id is casted as a string
    ];
}
