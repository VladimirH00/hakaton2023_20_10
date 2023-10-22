<?php

namespace App\Models\Specialist;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialistType extends Model
{
    use HasFactory;

    protected $table = 'specialist_types';

    public function specialists()
    {
        return $this->hasMany(Specialist::class);
    }
}
