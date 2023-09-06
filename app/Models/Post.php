<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = [
        'title', 'write_id','description', 'status'
    ];
    public function write(): BelongsTo
    {
        return $this->belongsTo(Write::class, 'write_id');
    }
}
