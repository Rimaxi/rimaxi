<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Write extends Model
{
    use HasFactory;
    protected $table = 'writes';
    protected $fillable = [
        'write' ,'email', 'status'
    ];

    public function group(): HasMany
    {
        return $this->hasMany(Post::class, 'write_id', 'id');
    }
}
