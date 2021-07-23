<?php

namespace App\Models;

use Plank\Metable\Metable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

class Media extends BaseMedia
{
    use HasFactory;
    use Metable;

    public static function boot()
	{
        parent::boot();
		static::created(function (Media $model) {
                $model->setMeta("optimized", 0);
        });
	}

    public static function paginate($model, string $collection)
    {
        $request = request();
        $perPage = $request->per_page ?? 20;
        $page = $request->page ?? 1;
        $skip = $perPage * ($page - 1);
        $media = [
            'total' => $model->media()->where('collection_name', $collection)->count(),
            'page' => intval($page),
            'per_page' => intval($perPage),
            'count' => 0,
            'images' => []
        ];
        foreach ($model->media()->where('collection_name', $collection)
                            ->skip($skip)->limit($perPage)->get() as $image) {
                $media['images'][] = [
                   'original' =>  $image->getFullUrl(),
                   'thumbnail' => $image->getFullUrl('thumbnail'),
                ];
        }
        $media['count'] = count($media['images']);
        $media['has_next'] = ($media['count'] == $perPage) && $perPage != $media['total'];
        return $media;
    }
}
