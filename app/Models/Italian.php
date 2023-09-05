<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Italian extends Model
{
    use HasFactory;
    protected $table = 'italians';
    protected $fillable = [
      'name',
      'description',
      'price',
    ];
}
