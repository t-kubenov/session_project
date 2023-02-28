<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SessionModel;
use Jenssegers\Agent\Agent;

class UserAuth extends Controller
{
    //
    function userLogin(Request $request){

        $data = $request->input();
        $request->session()->put("user", $data['user']);
        return redirect("profile");
    }

    public function index(){
        $session = SessionModel::all();
        $agent = new Agent();
        $session->push($agent->browser());
        dd(
            $session
        );
    }
}
