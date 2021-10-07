<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionApiController extends Controller
{
    public function byRegion(Region $region)
    {
        $subs = $region->subscriptions->toArray();
        if (!empty($subs)) {
            return $subs;
        }

        return Subscription::query()
            ->where("is_default", true)
            ->get();
    }
}
