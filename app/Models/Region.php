<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'code';
    }

    protected $guarded = [];

    public function subscriptions(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphedByMany(Subscription::class, 'related', 'region_relations');
    }
}
