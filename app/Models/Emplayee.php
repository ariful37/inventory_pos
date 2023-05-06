<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emplayee extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'email', 'phone','address','nid','photo','joining_date'
    ];
}
