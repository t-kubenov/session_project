<?php

namespace App\Http\Controllers;

use App\Models\SessionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sessions = SessionModel::select('id', 'browser', 'browserVersion', 'platform', 'ip_address', 'last_activity');
        $other_sessions = $sessions->where('user_id','=', Auth::id())->get();
        $current_session = $sessions->where('id', '=', Session::getId())->get();
        return view('home', ['other_sessions' => $other_sessions, 'current_session' => $current_session[0]]);
    }

    public function deleteSession(Request $request): \Illuminate\Http\RedirectResponse
    {
        $record = SessionModel::where('id', '=', $request->id)->first()->delete();
        return Redirect::home();
    }

    public function deleteAllSessions()
    {
        $record = SessionModel::where([['user_id', '=', Auth::id()], ['id', '<>', Session::getId()]])->delete();
        return Redirect::home();
    }
}
