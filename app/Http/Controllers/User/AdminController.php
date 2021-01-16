<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Ads;
use App\Kategori;
use App\User;
use App\Member;
use App\Kelas;
use App\Produk;
use App\Status;
use File;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Notifications\Notifiable;

class AdminController extends Controller
{
/*/ Management User /*/

    //menampilkan data member
    public function getMember(){
    	$member = User::with('member')->where('id_role',2)->get();
    	return response()->json([
            'message' => 'Success',
            'totalData' => sizeof($member),
            'members' => $member->toArray()
        ], 200);
    }

/*/ Managemen Kelas /*/

    //membuat kelas
    public function createClass(Request $request){
        $kategori_kelas = Kategori::where('kategori_untuk','=','kelas')->get();

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'poster' => 'image|mimes:jpeg,png,jpg|max:2000',
            'deskripsi' => 'required|string',
            'link_video' => 'required|string',
            'biaya' => 'required|int',
            'id_kategori' => 'required|int',
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
            $class->biaya =  $request->biaya;
            $class->id_kategori =  $request->id_kategori;
            $class->id_status =  4;
            
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

    //menampilkan semua kelas
    public function showClass()
    {   
        $class = Kelas::all();
        return response()->json([
            'message' => 'Success',
            'totalData' => sizeof($class),
            'classes' => $class->toArray()
        ], 200);
    }

    //mengubah kelas yang ada
    public function updateClass(Request $request, $id){
        $class = Kelas::findOrFail($id);
        $nama = $class->poster;
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'poster' => 'image|mimes:jpeg,png,jpg|max:2000',
            'deskripsi' => 'required|string',
            'link_video' => 'required|string',
            'biaya' => 'required|int',
            'id_kategori' => 'required|int',
        ]);
        if ($validator->fails()) {    
            return response()->json($validator->messages(), 422);
        }
        $class->nama =  $request->nama;
        $class->deskripsi =  $request->deskripsi;
        $class->link_video =  $request->link_video;
        $class->biaya=  $request->biaya;
        $class->id_kategori=  $request->id_kategori;
        $class->id_status=  $request->id_status;
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

    //menghapus kelas
    public function deleteClass($id)
    {
        Kelas::findOrFail($id)->delete();

        return response()->json([
                'status' => 'Success',
                'message' => 'deleted success'
        ],200);
    } 

/*/ Managemen Produk /*/

    //memasukkan produk
    public function inputProduct(Request $request){
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required|string',
            'gambar_produk' => 'image|mimes:jpeg,png,jpg|max:2000',
            'harga_produk' => 'required|int',
            'deskripsi_produk' => 'required|string',
        ]);
        if ($validator->fails()) {    
            return response()->json($validator->messages(), 422);
        }
        DB::beginTransaction();
        try{
            $produk = new Produk;
            $produk->nama_produk =  $request->nama_produk;
            $produk->harga_produk =  $request->harga_produk;
            $produk->deskripsi_produk =  $request->deskripsi_produk;
            $produk->id_kategori = $request->id_kategori;
            $produk->id_status = $request->id_status;
            
            if($request->hasfile('gambar_produk')){
                $file = $request->file('gambar_produk');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/produk/', $filename);
                $produk->gambar_produk = $filename;
            }
            $produk->save();
        }catch(\Exception $e){
            DB::rollback();
            return response()->json(['status' => 'Input Product Failed', 'message' => $e->getMessage()]);
        }
        DB::commit();
        return response()->json([
            'status' => 'Success',
            'data' => [
                'produk' => $produk->toArray()
            ],
        ],201);
    }

    //menampilkan semua produk
    public function AllProduct()
    {   
        $produk = Produk::all();
        return response()->json([
            'message' => 'Success',
            'totalData' => sizeof($produk),
            'products' => $produk->toArray()
        ], 200);
    }

    //mengubah produk
    public function updateProduct(Request $request, $id){
        $produk = Produk::findOrFail($id);
        $nama = $produk->gambar_produk;
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required|string',
            'gambar_produk' => 'image|mimes:jpeg,png,jpg|max:2000',
            'harga_produk' => 'required|int',
            'deskripsi_produk' => 'required|string',
        ]);
        if ($validator->fails()) {    
            return response()->json($validator->messages(), 422);
        }
        $produk->nama_produk =  $request->nama_produk;
        $produk->harga_produk =  $request->harga_produk;
        $produk->deskripsi_produk =  $request->deskripsi_produk;
        $class->update($request->all());
            if($request->hasfile('gambar_produk')){
                $productImage = public_path('uploads/produk/'.$nama); // get previous image from folder
                if (File::exists($productImage)) { // unlink or remove previous image from folder
                    unlink($productImage);
                }
                $file = $request->file('gambar_produk');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/produk/', $filename);
                $produk->gambar_produk = $filename;
                $produk->save();
            }
    }

    //menghapus produk
    public function deleteProduct($id)
    {
        Produk::findOrFail($id)->delete();

        return response()->json([
                'status' => 'Success',
                'message' => 'deleted success'
        ],200);
    }

/*/ Kategori /*/

    public function indexCategory(){
        $kategori = Kategori::get();
        // return response()->json(Kategori::all());
        if(sizeof($kategori) > 0)
            return response()->json([
                'status' => 'Success',
                'totalData' => sizeof($kategori),
                'data' => [
                    'kategori' => $kategori->toArray()
                ],
            ],200);
        else{
            return response(['Belum ada kategori'],404);
        }
    }

    public function showCategory($id)
    {   
        $kategori = Kategori::findOrFail($id);
        // return response()->json('Kategori',$kategori);
            return response()->json([
                'status' => 'Success',
                'data' => [
                    'kategori' => $kategori->toArray()
                ],
            ],200);       
    }

    public function createCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|string',
            'kategori_untuk' => 'required|string'
        ]);
        if ($validator->fails()) {    
            return response()->json($validator->messages(), 422);
        }
        $kategori= Kategori::create($request->all());

        return response()->json([
            'status' => 'Success',
                'data' => [
                    'kategori' => $kategori->toArray()
                ],
            ],200);
    }

    public function updateCategory($id, Request $request)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->all());

        return response()->json([
            'status' => 'Updated!',
                'data' => [
                    'kategori' => $kategori->toArray()
                ],
            ],200);
    }
    
    public function deleteCategory($id)
    {
        Kategori::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }

/*/ Status /*/

    public function indexStatus(){
        $status = Status::get();
        // return response()->json(Kategori::all());
        if(sizeof($status) > 0)
            return response()->json([
                'status' => 'Success',
                'totalData' => sizeof($status),
                'data' => [
                    'status' => $status->toArray()
                ],
            ],200);
        else{
            return response(['Belum ada status'],404);
        }
    }

    public function createStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'string'
        ]);
        if ($validator->fails()) {    
            return response()->json($validator->messages(), 422);
        }
        $status= Status::create($request->all());

        return response()->json([
            'status' => 'Success',
                'data' => [
                    'status' => $status->toArray()
                ],
            ],200);
    }

    public function updateStatus($id, Request $request)
    {
        $status = Status::findOrFail($id);
        $status->update($request->all());

        return response()->json([
            'status' => 'Updated!',
                'data' => [
                    'status' => $status->toArray()
                ],
            ],200);
    }
    
    public function deleteStatus($id)
    {
        Status::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}