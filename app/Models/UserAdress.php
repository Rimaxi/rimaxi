<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class UserAdress extends Model
{
    use HasFactory;
    protected $table = 'user_adresses';
    protected $fillable = [
        'useraddress', 'user_id',
    ];
    public function user_address(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
