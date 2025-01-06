<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    public function detail()
    {
        return $this->hasOne(UserDetails::class);
    }

    public function companydetail()
    {
        return $this->hasOne(CompanyDetails::class);
    }
}
