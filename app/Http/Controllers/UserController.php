<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Helper;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Shows the settings for the User
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();

        return view('admin.index', compact('user'));
    }

    /**
     * ================================================================
     *                       PROFILE FUNCTIONS
     * ================================================================
     */

    /**
     * Update E-Mail address
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateMail(Request $request, $id)
    {
        // Find user by id
        $user = User::find($id);

        // Validate E-Mail format
        if ($request->input('email') != $user->email) {
            $validator = Validator::make($request->all(), [
                'email' => 'email|required|unique:users,email',
            ]);
        }

        // Validation fail redirect
        if ($validator->fails()) {
            return redirect()->route('user.index', $user->id)
                ->withInput()
                ->withErrors($validator);
        }

        // Processing the data of the Request
        if ($request->input('email') != $user->email) {
            $user->email = $request->input('email');
        }

        // Updating the E-Mail address within the DB
        $user->update([
            'email' => $request->get('email'),
        ]);

        return redirect()
            ->route('user.index', $user->id)
            ->with('flashType', 'success')
            ->with('message', 'E-Mail address successfully changed.');
    }

    /**
     * ================================================================
     *                      PASSWORD FUNCTIONS
     * ================================================================
     */

    public function password()
    {
        $user = Auth::user();

        return view('user.password', compact('user'));
    }

    /**
     * Update the password
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request, $id)
    {
        // Find user by id
        $user = User::find($id);

        // Validation
        $validator = Validator::make($request->all(), [
            'password' => 'min:6|confirmed|required_with:password_confirmation',
        ]);

        if ($validator->fails()) {
            return redirect()->route('user.password', $user->id)
                ->withInput()
                ->withErrors($validator);
        }

        // Updating the data within the DB
        $user->update([
            'password' => bcrypt($request->get('password'))
        ]);

        return redirect()
            ->route('user.password', $user->id)
            ->with('flashType', 'success')
            ->with('message', 'Password successfully changed.');
    }
}
