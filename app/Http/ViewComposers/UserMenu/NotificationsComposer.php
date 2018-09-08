<?php

namespace App\Http\ViewComposers\UserMenu;

use App\Models\Notification;
use Illuminate\View\View;

class NotificationsComposer
{
    /**
     * Bind data to the view
     * @param  View  $view
     * @return void
     */
    public function compose(View $view): void
    {
        $notifications = notification::where([
            ['user_id', user()->id],
            ['created_at', '>', user()->notif_check],
        ])->count();

        if (user()->isadmin()) {
            $notifications_for_admin = notification::where([
                ['for_admins', 1],
                ['created_at', '>', user()->notif_check],
            ])->count();
            $notifications += $notifications_for_admin;
        }
        $view->with(compact('notifications'));
    }
}
