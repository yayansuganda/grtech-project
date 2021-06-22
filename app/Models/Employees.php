<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;

    public $fillable = ['first_name',
                        'last_name',
                        'company_id',
                        'email',
                        'phone'];
    protected $appends = ['full_name'];


    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getCompanies()
    {
        return $this->belongsTo(Companies::class, 'company_id', 'id');
    }

}
