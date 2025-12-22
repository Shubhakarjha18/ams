<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Company extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'email',
        'phone',
        'website',
        'company_code',
        'company_key'
    ];
    public function users(){
        return $this->hasMany(User::class);
    }
}
