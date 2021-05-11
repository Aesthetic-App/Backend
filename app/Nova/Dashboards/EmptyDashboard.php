<?php

namespace App\Nova\Dashboards;

use Pdmfc\NovaCards\Info;
use Laravel\Nova\Dashboard;

class EmptyDashboard extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
            return [
        (new Info())
            ->info('Some info message')
    ];

    }

    /**
     * Get the URI key for the dashboard.
     *
     * @return string
     */
    public static function uriKey()
    {
        return 'empty-dashboard';
    }
}
