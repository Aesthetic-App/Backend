<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranslationMessage extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'messages'];

    protected $casts = [
      'messages' => 'array'
    ];
}
