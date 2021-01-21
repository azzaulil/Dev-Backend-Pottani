<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Response;
use App\User;
use App\Member;
use App\Kelas;
use App\MemberClass;
use App\ClassCategory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //menampilkan semua kelas di halaman beranda
    public function showAllClass(){
        $class_open = Kelas::where('id_status','=', 4)->get();
        $class_close = Kelas::where('id_status','=', 6)->get();
            if(sizeof($class_open) > 0){
                return response()->json([
                    'status' => 'Success',
                    'data' => [
                        'kelas yang buka' => $class_open->toArray(),
                        'kelas yang tutup' => $class_close->toArray(),
                    ],
                ],200);
            }else{
                return response()->json([
                    'status' => 'Success',
                    'data' => [
                        'kelas yang tutup' => $class_close->toArray()
                    ],
                ],200);
            }
    }

    //Menampilkan detail kelas yang dipilih
    public function showDetailClass($id_class)
    {   
        $class = Kelas::findOrFail($id_class);
            return response()->json([
                'status' => 'Success',
                'data' => [
                    'class' => $class->toArray()
                ],
            ],200);
    }
}
