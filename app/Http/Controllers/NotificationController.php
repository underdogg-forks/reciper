<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = Notification::whereUserId(user()->id);

		if (user()->isAdmin()) {
			$notifications->orWhere('for_admins', 1);
		}

		$query = $notifications->latest()->paginate(10);

		User::whereId(user()->id)->update([
			'notif_check' => NOW()
		]);

		return view('notifications.index')
			->withNotifications($query);
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
	 * @param Notification $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
		if ($notification->for_admins !== 1) {
			$notification->delete();
			return redirect('notifications')
				->withSuccess(trans('notifications.deleted'));
		}
        return redirect('notifications');
    }
}