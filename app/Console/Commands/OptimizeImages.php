<?php

namespace App\Console\Commands;

use App\Models\Media;
use Illuminate\Console\Command;
use Plank\Metable\Meta;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

use function Tinify\fromFile;

class OptimizeImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'image:optimize';

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
        $metas = Meta::where('metable_type', 'App\\Models\\Media')->where('key', 'optimized')->where('value', false)
            ->select("metable_id")->pluck("metable_id");
        
        $medias = Media::query()->whereIn("id", $metas)->get();
            
        foreach($medias as $media) {
            $source = fromFile($media->getPath());
            $source->toFile($media->getPath());
            $this->line($media->file_name . " - File optimized.");
            $media->setMeta("optimized", 1);
        }
        // foreach(glob(storage_path("app/public/**/*-nopt-.jpg")) as $file) {
        //     ImageOptimizer::optimize($file, str_replace("-nopt-", "", $file));
        // }
        return 0;
    }
}
