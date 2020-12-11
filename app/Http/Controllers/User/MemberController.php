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

class MemberController extends Controller
{
/*/ Unauthorization/belum login /*/

    //menampilkan semua kelas di halaman beranda
    public function showAllClass(){
        $datenow = Carbon::now();
        $class_open = Kelas::where('date_class','>=', $datenow)->get();
        $class_close = Kelas::where('date_class','<', $datenow)->get();
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

/*/ Authorization/sudah login /*/    

    //mendaftar kelas
    public function registerClass(Request $request){
        $auth = Auth::user()->member;
        $id = $auth->id_member;

        $member_class = new MemberClass;
        $member_class->id_member = $id;
        $member_class->id_status = 5; //terdaftar
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
            return response()->json([
                'status' => 'Success',
                'data' => $member_class
            ], 201);
        }
    }

    //menampilkan kelas yang didaftar member A
    public function showClassRegister(){
        $auth = Auth::user()->member;
        $id = $auth->id_member;

        $member_class = MemberClass::where( 'id_status', '=', 5)
                   ->where( 'id_member','=', $id)
                ->get();
                if(sizeof($member_class) > 0){
                    return response()->json([
                        'status' => 'Success',
                        'size' => sizeof($member_class),
                        'data' => [
                            'class' => $member_class->toArray()
                        ],
                    ]);
                }else if(sizeof($member_class) == 0){
                    return response()->json([
                        'status' => 'Success',
                        'size' => sizeof($member_class),
                        'data' => [
                            'member_class' => $member_class->toArray()
                        ],
                    ],200);
                }else{
                    return response(['Belum ada peserta'],404);
                }
    }

    //Menampilkan detail kelas yang didaftar member A
    public function showDetailClassRegister($id_class)
    {   
        $auth = Auth::user()->member;
        $id = $auth->id_member;

        $class = Kelas::with('member_class')
                ->whereHas('member_class', function ($query) use($id) {
                        $query->where('id_member', '=', $id);
                })->findOrFail($id_class);

            return response()->json([
                'status' => 'Success',
                'data' => [
                    'class' => $class->toArray()
                ],
            ],200);
    }

    //menampilkan profile member
    public function showProfile()
    {
        $auth = Auth::user()->member;
        $id = $auth->id_member;
        $member = User::with('member')
                    ->whereHas('member', function ($query) use($id){
                         $query->where('id_member', '=', $id);
                    })->get();

        if(sizeof($member) > 0){
               return response()->json([
                  'status' => 'Success',
                  'size' => sizeof($member),
                  'data' => [
                     'user' => $member->toArray()
                  ],
             ]);
    
        }else if(sizeof($member) == 0){
            return response()->json([
                'status' => 'Success',
                'size' => sizeof($member),
                'data' => [
                    'user' => $member->toArray()
                ],
            ],200);
        }else{
                return response(['Belum ada peserta'],404);
        }
    }

    //mengedit data profil member
    public function updateProfile($id_member, Request $request)
    {
        $member = Member::findOrFail($id_member);
        $nama = $member->foto_profil;

        $users = User::findOrFail($member->id_member);
        $validator = Validator::make($request->all(), [
            // 'email' => 'email|unique:users',
            // 'password'=> 'min:8|confirmed',
            'nama_lengkap' => 'string',
            // 'tanggal_lahir' => 'date',
            'jenis_kelamin' => 'string',
            'telepon' => 'string',
            // 'umur' => 'integer',
        ]);
        if ($validator->fails()) {    
            return response()->json($validator->messages(), 422);
        }
        $member->update($request->all());
        if($request->hasFile('foto_profil'))
        {
            $usersImage = public_path('uploads/member/'.$nama); // get previous image from folder
            if (File::exists($usersImage)) { // unlink or remove previous image from folder
                unlink($usersImage);
            }
            $file = $request->file('foto_profil');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $file = $file->move('uploads/member/', $name);
            $member->foto_profil = $name;
            
        }
        $member->save();
        $users->update($request->all());
        return response()->json($member, 200);
    }

}
