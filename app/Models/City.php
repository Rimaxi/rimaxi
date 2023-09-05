<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
    use HasFactory;
    protected $table = 'city';
    protected $fillable = [
        'city', 'state_id','status'
    ];
    
    public function getGroup(): BelongsTo
    {
        return $this->belongsTo(State::class,'country_id');
    }
}
