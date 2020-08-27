<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Tips;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Check if table for tips exists
        if (Schema::hasTable('tips')) {
            // Get all tips
            $tips = Tips::all();

            // Get random tips
            if ($tips->count() >= 3) {
                $randomTips = $tips->random(3);
            } else {
                $randomTips = null;
            }
            view()->share('randomTips', $randomTips);
        }
    }
}
