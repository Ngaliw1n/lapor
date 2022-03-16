<?php

namespace App\Http\Controllers;

use App\Models\Perbaikan;
use Illuminate\Http\Request;
use DB;

class PerbaikanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.perbaikan.index');
    }

    public function indexAdmin()
    {              
        $datas = DB::table('perbaikan')
                ->join('mesins','perbaikan.id_mesins','=','mesins.id_mesin', 'right outer')
                ->join('outlets','perbaikan.id_outlets','=','outlets.outlets_id', 'right outer')
                ->join('users','perbaikan.id_pelapor','=','users.id', 'right outer')              
                ->select('mesins.id_mesin','mesins.nm_mesin','outlets.outlets_id','outlets.nm_outlet', 'users.id','users.name','perbaikan.*')
                ->groupBy('perbaikan.id_perbaikan')
                ->paginate(10);

        $datas2 = DB::table('outlets')
                ->select('outlets.*')
                ->get();
                
        $datas3 = DB::table('mesins')
                ->select('mesins.*')
                ->get();

        $datas4 = DB::table('users')
                ->select('users.*')
                ->get();

        return view('admin.perbaikan.index',compact('datas','datas2','datas3','datas4'));
    }

    public function cari(Request $request)
	{
		// menangkap data pencarian
		$cari = $request->cari;
    		// mengambil data dari table pegawai sesuai pencarian data
		
        $datas = DB::table('perbaikan')
                ->join('mesins','perbaikan.id_mesins','=','mesins.id_mesin', 'right outer')
                ->join('outlets','perbaikan.id_outlets','=','outlets.outlets_id', 'right outer')
                ->join('users','perbaikan.id_pelapor','=','users.id', 'right outer')              
                ->select('mesins.id_mesin','outlets.outlets_id','outlets.nm_outlet', 'users.id','users.name','perbaikan.*')
                //->select('mesins.id_mesin','outlets.nm_outlet', 'outlets.outlets_id','users.id','users.name','perbaikan.*')
                ->groupBy('perbaikan.id_perbaikan')
                ->where('perbaikan.nm_perbaikan','like',"%".$cari."%")
                ->paginate(10);
        $datas2 = DB::table('outlets')
                 ->select('outlets.*')
                 ->get();
        $datas3 = DB::table('mesins')
                 ->select('mesins.*')
                 ->get();
        $datas4 = DB::table('users')
                 ->select('users.*')
                 ->get();
 
         return view('admin.perbaikan.index',compact('datas','datas2','datas3','datas4')); 
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'nm_perbaikan' => 'required',
            'tgl' => 'required',
            'gmbr_perbaikan' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'detail' => 'required',
            'id_mesins'=> 'required',
            'id_outlets' => 'required',
            'id_pelapor' => 'required'
        ]);     
    
        $input = $request->all();
        // Outlet::create($request->all());

        if ($gmbr_perbaikan = $request->file('gmbr_perbaikan')) {
            $randomNumber = random_int(10, 9999);
            $destinationPath = 'image/';
            $profileImage = date('YmdHis').$randomNumber . "." . $gmbr_perbaikan->getClientOriginalExtension();
            $gmbr_perbaikan->move($destinationPath, $profileImage);
            $input['gmbr_perbaikan'] = "$profileImage";
        }

        Perbaikan::create($input);

        return redirect()->back()->with('sukses', 'Sukses Menambah Perbaikan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perbaikan  $perbaikan
     * @return \Illuminate\Http\Response
     */
    public function show(Perbaikan $perbaikan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perbaikan  $perbaikan
     * @return \Illuminate\Http\Response
     */
    public function edit($perbaikan)
    {
        $perbaikan = DB::table('perbaikan')->where('id_perbaikan', $perbaikan)->get(); 
        

        $datas2 = DB::table('outlets')
                ->select('outlets.*')
                ->get();
        $datas3 = DB::table('mesins')
                ->select('mesins.*')
                ->get();
        $datas4 = DB::table('users')
                ->select('users.*')
                ->get();
       
        return view('admin.perbaikan.index',compact('perbaikan','datas2','datas3','datas4'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perbaikan  $perbaikan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $perbaikan)
    {
        $request->validate([
            
            'nm_perbaikan' => 'required',
            'tgl' => 'required',
            'gmbr_perbaikan' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'detail' => 'required',
            'id_mesins'=> 'required',
            'id_outlets' => 'required',
            'id_pelapor' => 'required'
        ]);
        $input = $request->except(['_token','_method']);
        
        if ($gmbr_perbaikan = $request->file('gmbr_perbaikan')) {
            $randomNumber = random_int(10, 9999);
            $destinationPath = 'image/';
            $profileImage = date('YmdHis').$randomNumber . "." . $gmbr_perbaikan->getClientOriginalExtension();
            $gmbr_perbaikan->move($destinationPath, $profileImage);
            $input['gmbr_perbaikan'] = "$profileImage";
        }else{
            unset($input['gmbr_perbaikan']);
        }
        DB::table('perbaikan')
              ->where('id_perbaikan', $perbaikan)
              ->update($input);

        return redirect()->route('perbaikan.indexAdmin')
                        ->with('edit','Data Perbaikan sukses diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perbaikan  $perbaikan
     * @return \Illuminate\Http\Response
     */
    public function destroy($perbaikan)
    {
        DB::table('perbaikan')->where('id_perbaikan', $perbaikan)->delete();
    
        return redirect()->back()->with('hapus', 'Berhasil menghapus Perbaikan');
    }
}
