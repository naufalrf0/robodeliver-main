<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Route;

class AdminBreadcrumbs
{
    public static function generate()
    {
        $segments = request()->segments();
        $breadcrumbs = [];

        $url = '';
        foreach ($segments as $segment) {
            $url .= '/' . $segment;

            $breadcrumbs[] = [
                'name' => ucfirst(str_replace('-', ' ', $segment)),
                'url' => url($url),
            ];
        }

        return $breadcrumbs;
    }
}
