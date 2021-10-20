<?php

namespace App\Console\Commands;

use App\Models\Icon;
use App\Models\Theme;
use App\Models\Wallpaper;
use App\Models\WallpaperCategory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class WallpapersMediaToResource extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:wallpapers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::beginTransaction();
        WallpaperCategory::query()->limit(2)->get()->each(function(WallpaperCategory $wc) {
            $wc->media()->where("collection_name", 'images')
                ->each(function(Media $media) use($wc) {
                    $wallpaper = Wallpaper::query()
                        ->updateOrCreate(
                            [
                                'name' => $media->id,
                            ],
                            [
                                'wallpaper_category_id' => $wc->id,
                                'sort_order' => $media->order_column
                            ]
                        );
                    $media->copy($wallpaper, 'wallpapers', 'public');
                });
        });
        DB::commit();
        return 1;
    }
}
