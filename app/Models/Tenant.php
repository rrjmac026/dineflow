<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = [
        'name',
        'email',
        'subdomain',
        'database_name',
        'active'
    ];

    protected $hidden = [
        'password',
    ];
}