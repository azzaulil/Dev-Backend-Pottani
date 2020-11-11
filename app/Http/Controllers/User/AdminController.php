<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Member;

class AdminController extends Controller
{
    public function getMember(){
    	$member = User::with('member')->where('id_role',2)->get();

    	return response()->json([
            'message' => 'Success',
            'totalData' => sizeof($member),
            'members' => $member->toArray()
        ], 200);
    }
}
