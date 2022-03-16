<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')->orderBy('id')->paginate(10);
        return view('admin.user',['users' => $users]);
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'is_admin' => 'required',
            'password' => 'required',
        ]);
        $request->request->add(['password' => Hash::make($request->password)]);         
    
        User::create($request->all());
        return redirect()->back()->with('sukses', 'Sukses menambah Akun');
    }
     
    public function show(User $users)
    {
        
    }
     
    public function edit(User $user)
    {
        return view('admin.userEdit',compact('user'));
    }
    
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'is_admin' => 'required',
            'password' => 'required',
        ]);
        $request->request->add(['password' => Hash::make($request->password)]); 
        $input = $request->all();
          
        $user->update($input);
    
        return redirect()->route('users.index')
                        ->with('edit','Akun sukses diedit');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($userManage)
    {
        DB::table('users')->where('id', $userManage)->delete();
    
        return redirect()->back()->with('hapus', 'Berhasil menghapus Akun');
    }

    public function cari(Request $request)
	{
		// menangkap data pencarian
		$cari = $request->cari;
 
    		// mengambil data dari table pegawai sesuai pencarian data
		$users = DB::table('users')
		->where('name','like',"%".$cari."%")
		->paginate();
 
    		// mengirim data pegawai ke view index
		return view('admin.user',['users' => $users]);
 
	}
}
