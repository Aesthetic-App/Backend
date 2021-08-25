<?php

namespace App\Observers;

use App\Models\Theme;
use App\Models\ThemeCategory;

class ThemeObserver
{
    public static function creating(Theme $theme) {
        if (array_key_exists("new_category_title", $theme->getAttributes())) {
            if (!empty($theme->new_category_title))  {
                $id = ThemeCategory::create(['title' => $theme->new_category_title]);
                request()->merge(["new_category_id" =>$id]);
            }
             unset($theme->new_category_title);
        }
    }

    public static function created(Theme $theme) {
        if (request()->has('new_category_id')) {
            $theme->categories()->attach(request()->new_category_id);
        }
    }
}