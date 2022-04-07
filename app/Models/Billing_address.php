<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing_address extends Model
{
    use HasFactory;
    protected $table='address';
    protected $fillable=[
        'id',
        'user_id',
        'name',
        'email',
        'mobile_number',
        'state',
        'city',
        'pincode',
        'address',
        'created_at',
        'updated_at',
    ];

}
