<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function regions(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphToMany(Region::class, 'related','region_relations');
    }
}
