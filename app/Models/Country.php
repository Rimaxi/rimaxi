<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;
    protected $table = 'country';
    protected $fillable = [
        'countryname' , 'status'
    ];

    public function group(): HasMany
    {
        return $this->hasMany(State::class, 'country_id', 'id');
    }

}
