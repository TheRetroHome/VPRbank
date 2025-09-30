<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Message;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer(['layouts.partials.sidebar', 'messages.*', 'home'], function ($view) {
            if (auth()->check()) {
                $unreadCount = Message::where('recipient_id', auth()->id())
                                    ->where('is_read', false)
                                    ->count();
                
                $view->with('unreadCount', $unreadCount);
            }
        });
    }
}
