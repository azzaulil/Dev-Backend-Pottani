<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Response;
use App\Kelas;
use App\MemberClass;

class MemberController extends Controller
{
    public function getKelas()
    {   
        $class = Kelas::all();
    }

    public function registerClass(Request $request){
        $auth = Auth::user()->member;
        $id = $auth->id_member;

        $member_class = new MemberClass;
        $member_class->id_member = $id;
        $member_class->id_status = 5;
        $member_class->id_class = $request->id_class;
        $listmember = MemberClass::where([
            ['id_class','=', $member_class->id_class],
            ['id_member','=', $member_class->id_member]
        ])->get();
    
        if(sizeof($listmember) > 0){
            return response()->json([
                'status' => 'Terdaftar',
                'messages' => 'Anda sudah mendaftar kelas ini. Silahkan menunggu konfirmasi 1x24jam di email anda'
            ]);
        }else{
            $member_class->save();
            return response()->json($member_class, 201);
        }
    }

//menampilkan kelas yang didaftar
    public function showClassRegister(){
        $auth = Auth::user()->member;
        $id = $auth->id_member;

        $member = MemberClass::where( 'id_status', '=', 5)
                   ->where( 'id_member','=', $id)
                ->get();
                if(sizeof($member) > 0){
                    return response()->json([
                        'status' => 'Success',
                        'size' => sizeof($member),
                        'data' => [
                            'class' => $member->toArray()
                        ],
                    ]);
                }else if(sizeof($member) == 0){
                    return response()->json([
                        'status' => 'Success',
                        'size' => sizeof($member),
                        'data' => [
                            'class' => $member->toArray()
                        ],
                    ],200);
                }else{
                    return response(['Belum ada peserta'],404);
                }
    }

}
