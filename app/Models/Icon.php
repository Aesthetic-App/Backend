<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Icon extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use SortableTrait;

    protected $guarded = [];

    protected $hidden = ['media'];

    public $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
    ];

    protected $appends = ['custom', 'original'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function ($builder) {
            $builder->orderBy('sort_order', 'asc');
        });
    }

    public function theme(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Theme::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumbnail')
            ->width(127)
            ->height(412);

        $this->addMediaConversion('small-image')
            ->width(130)
            ->height(130);
    }

    public function getCustomAttribute()
    {
        $x = $this->getFirstMedia("custom_icon");
        return [
            'normal' => $x ? $x->getFullUrl() : '',
            'thumbnail' => $x ? $x->getFullUrl('thumbnail') : '',
        ];
    }

    public function getOriginalAttribute()
    {
        $x = $this->getFirstMedia("original_icon");
        return [
            'normal' => $x ? $x->getFullUrl() : '',
            'thumbnail' => $x ? $x->getFullUrl('thumbnail') : '',
        ];
    }
}
