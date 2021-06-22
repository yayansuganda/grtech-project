<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    use HasFactory;

    public $fillable = ['name',
                        'email',
                        'logo',
                        'website'];


    public function getEmployees(){
        return $this->hasMany(Employees::class);
    }
}
