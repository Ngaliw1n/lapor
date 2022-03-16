<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\User;
use DB;

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
        return view('user.home');
    }

    public function adminHome()
    {
        // $users = User::latest()->paginate(2);
        $users = DB::table('users')->count();
        $outlets = DB::table('outlets')->count();
        $mesins = DB::table('mesins')->count();
        $perbaikan = DB::table('perbaikan')->count();
        // $users = DB::table('outlets')
        //     ->select(DB::raw('count(outlets.id) as jml_outlet'), DB::raw('count(mesins.id_mesin) as jml_mesin'))
        //     ->join('mesins','outlets.id','=','mesins.id_outlet')
        //     ->get();
        //     dd($users);
    
        // return view('admin.user',compact('users'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);

        return view('admin.adminHome',compact('users', 'outlets', 'mesins', 'perbaikan'));
        // return view('admin.adminHome'); 
    }
    public function spvHome()
    {
        return view('spv.home'); 
    }
}
