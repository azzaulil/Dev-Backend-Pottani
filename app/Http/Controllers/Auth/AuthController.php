<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\User;
use App\Member;
use DB;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);
        DB::beginTransaction();
        try{
            $users = new User;
            $users->email = $request->email;
            $users->password = bcrypt($request->password);
            $users->id_role=2;
            $users->save();
            
        }catch(\Exception $e){
            DB::rollback();
            return response()->json(['status' => 'Register Members Failed', 'message' => $e->getMessage()]);
        }
        try{
            $member = new Member;
            $member->id_users = $users->id_users;
            $member->nama_lengkap = $request->nama_lengkap;
            $member->usia = $request->usia;
            $member->alamat = $request->alamat;
            $member->telepon = $request->telepon;
            $member->jenis_kelamin = $request->jenis_kelamin;
            
            if($request->hasfile('foto_profil')){
                $file = $request->file('foto_profil');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/member/', $filename);
                $member->foto_profil = $filename;
            }
            $member->save();
        }catch(\Exception $e){
            DB::rollback();
            return response()->json(['status' => 'Register Member Failed', 'message' => $e->getMessage()]);
        }
        DB::commit();
        
        return response()->json([
            'status' => 'Created',
            'message' => 'Successfully registered as Member!'
        ], 201);
    }
    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = request(['email', 'password']);
        if(Auth::attempt($credentials)){
           if(Auth::user()->is_active == 1){
                $user = $request->user();
                $tokenResult = $user->createToken('Personal Access Token');
                $token = $tokenResult->token;
                $token->save();
                
                if($user->id_role == 2){
                    $member = Member::where('id_users', '=', $user->id_users )->get();
                    $user = User::where('id_users', '=', $user->id_users )->get();
                    $users =$user->toArray();
                    $members=$member->toArray();
                    return response()->json([
                        'status' => 'Success',
                        'token' => $tokenResult->accessToken,
                        'id_role' =>array_values($users)[0]['id_role'],
                        'email' => array_values($users)[0]['email'],
                        // 'foto_profil'=>array_values($members)[0]['image_URL'],
                    ]);
                
                }else if($user->id_role == 1){
                    return response()->json([
                        'status' => 'Success',
                        'id_role' => 1,
                        'token' => $tokenResult->accessToken,
                        'role' => 'admin'
                    ]);
                }
           }else if(Auth::user()->is_active == 0){
                return response()->json([
                    'status' => 'Deactive',
                    'message' => 'Akun anda masih belum aktif, silahkan cek email kembali untuk melihat link aktivasi'
                ], 401);
           }
        }else{
            return response()->json([
                'message' => 'Email anda belum terdaftar, silahkan register terlebih dahulu'
            ], 401);
        }
    }
  
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
  
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
