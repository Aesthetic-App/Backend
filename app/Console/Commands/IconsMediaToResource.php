<?php

namespace App\Console\Commands;

use App\Models\Icon;
use App\Models\Theme;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class IconsMediaToResource extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:icons';

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
        Theme::query()->take(5)->each(function(Theme $theme) {
            $theme->media()->where("collection_name", 'icons')
                ->each(function(Media $media) use($theme) {
                    $icon = Icon::query()
                        ->create([
                            'name' => $media->id,
                            'theme_id' => $theme->id,
                            'sort_order' => $media->order_column
                        ]);
                    $media->copy($icon, 'custom_icon', 'public');
                });
        });
        DB::commit();
        return 1;
    }
}
