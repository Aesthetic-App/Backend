<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranslationMessage extends Model
{
    use HasFactory;

    protected $primaryKey = 'key';
    protected $keyType = 'string';
    protected $fillable = ['key', 'messages'];

    protected $casts = [
      'messages' => 'array'
    ];
}
