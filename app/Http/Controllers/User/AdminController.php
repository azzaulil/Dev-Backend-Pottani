<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Member;
use App\Kelas;
use File;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Notifications\Notifiable;


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

    public function createClass(Request $request){
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'poster' => 'required|image|mimes:jpeg,png,jpg|max:2000',
            'deskripsi' => 'required|string',
            'link_video' => 'required|string',
            'biaya' => 'required|int',
        ]);
        if ($validator->fails()) {    
            return response()->json($validator->messages(), 422);
        }
        DB::beginTransaction();
        try{
            $class = new Kelas;
            $class->nama =  $request->nama;
            $class->deskripsi =  $request->deskripsi;
            $class->link_video =  $request->link_video;
            $class->biaya=  $request->biaya;
            
            if($request->hasfile('poster')){
                $file = $request->file('poster');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/kelas/', $filename);
                $class->poster = $filename;
            }
            $class->save();
        }catch(\Exception $e){
            DB::rollback();
            return response()->json(['status' => 'Create Class Failed', 'message' => $e->getMessage()]);
        }
        DB::commit();
        return response()->json([
            'status' => 'Success',
            'data' => [
                'class' => $class->toArray()
            ],
        ],201);
    }

    public function updateClass(Request $request, $id){
        $class = Kelas::findOrFail($id);
        $nama = $class->poster;
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'poster' => 'required|image|mimes:jpeg,png,jpg|max:2000',
            'deskripsi' => 'required|string',
            'link_video' => 'required|string',
            'biaya' => 'required|int',
        ]);
        if ($validator->fails()) {    
            return response()->json($validator->messages(), 422);
        }
        $class->nama =  $request->nama;
        $class->deskripsi =  $request->deskripsi;
        $class->link_video =  $request->link_video;
        $class->biaya=  $request->biaya;
        $class->update($request->all());
            if($request->hasfile('poster')){
                $classPoster = public_path('uploads/kelas/'.$nama); // get previous image from folder
                if (File::exists($classPoster)) { // unlink or remove previous image from folder
                    unlink($classPoster);
                }
                $file = $request->file('poster');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/kelas/', $filename);
                $class->poster = $filename;
                $class->save();
            }
    }

    public function showClass()
    {   
        $class = Kelas::all();
        return response()->json([
            'message' => 'Success',
            'totalData' => sizeof($class),
            'classes' => $class->toArray()
        ], 200);
    }

    public function deleteClass($id)
    {
        Kelas::findOrFail($id)->delete();

        return response()->json([
                'status' => 'Success',
                'message' => 'deleted success'
        ],200);
    } 
}
