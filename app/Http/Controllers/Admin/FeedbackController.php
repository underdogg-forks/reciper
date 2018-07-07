<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeedbackController extends Controller
{
    /**
     * Mark user as he saw these messages
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        User::whereId(user()->id)->update([
			'contact_check' => now()
		]);

		return view('admin.feedback.index', [
			'feedback' => Feedback::paginate(40)
		]);
	}

    /**
     * Remove the specified resource from storage
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Check for correct user
        if (!user()->isAdmin()) {
            return redirect('/feedback')->withError(
				trans('admin.only_admin_can_delete')
			);
        }
		Feedback::find($id)->delete();

        return redirect('/admin/feedback')->withSuccess(
			trans('admin.feedback_has_been_deleted')
		);
    }
}
