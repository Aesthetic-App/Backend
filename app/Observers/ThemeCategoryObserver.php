<?php

namespace App\Observers;

use App\Models\Headline;
use App\Models\ThemeCategory;
use Exception;

class ThemeCategoryObserver
{
    public static function creating(ThemeCategory $themeCategory) {
        if (array_key_exists("new_headline_title", $themeCategory->getAttributes())) {
            if (!empty($themeCategory->new_headline_title))  {
                $id = Headline::create(['title' => $themeCategory->new_headline_title]);
                request()->merge(["new_headline_id" =>$id]);
            }
             unset($themeCategory->new_headline_title);
        }
        $themeCategory->title = "";
    }

    public static function created(ThemeCategory $themeCategory) {
        if (request()->has('new_headline_id')) {
            $themeCategory->headlines()->attach(request()->new_headline_id);
        }
    }
}