<?php

namespace App\Http\Controllers;

use App\Models\Sparepart;
use Illuminate\Http\Request;
use DB;

class SparepartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.sparepart.index');
    }

    public function indexAdmin()
    {
        // $datas = Sparepart::latest()->paginate(10);
        $datas = DB::table('spareparts')
                ->join('outlets','spareparts.id_outlets','=','outlets.outlets_id', 'right outer')
                ->join('mesins','spareparts.id_mesins','=','mesins.id_mesin', 'right outer')
                ->select('outlets.nm_outlet', 'outlets.outlets_id','mesins.id_mesin','mesins.nm_mesin','spareparts.*')
                ->groupBy('spareparts.id_spareparts')
                ->paginate(10);
        $datas2 = DB::table('outlets')
                ->select('outlets.*')
                ->get();
        $datas3 = DB::table('mesins')
                ->select('mesins.*')
                ->get();     
        return view('admin.sparepart.index',compact('datas','datas2','datas3'));
    }

    public function cari(Request $request)
	{
		// menangkap data pencarian
		$cari = $request->cari;
    		// mengambil data dari table pegawai sesuai pencarian data
		
        $datas = DB::table('spareparts')
                ->join('outlets','spareparts.id_outlets','=','outlets.outlets_id', 'right outer')
                ->join('mesins','spareparts.id_mesins','=','mesins.id_mesin', 'right outer')
                ->select('outlets.nm_outlet', 'outlets.outlets_id','mesins.id_mesin','mesins.nm_mesin','spareparts.*')
                ->groupBy('spareparts.id_spareparts')
		        ->where('spareparts.nm_spareparts','like',"%".$cari."%")
                ->paginate(10);
        $datas2 = DB::table('outlets')
                 ->select('outlets.*')
                 ->get();
        $datas3 = DB::table('mesins')
                 ->select('mesins.*')
                 ->get();
        return view('admin.sparepart.index',compact('datas','datas2','datas3')); 
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
            'nm_spareparts' => 'required',
            'gmbr_spareparts' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'kategori' => 'required',
            'spareparts_detail' => 'required',
            'id_mesins' => 'required',
            'id_outlets' => 'required'
        ]);     
    
        $input = $request->all();
        // Outlet::create($request->all());

        if ($gmbr_spareparts = $request->file('gmbr_spareparts')) {
            $randomNumber = random_int(10, 9999);
            $destinationPath = 'image/';
            $profileImage = date('YmdHis').$randomNumber . "." . $gmbr_spareparts->getClientOriginalExtension();
            $gmbr_spareparts->move($destinationPath, $profileImage);
            $input['gmbr_spareparts'] = "$profileImage";
        }

        Sparepart::create($input);

        return redirect()->back()->with('sukses', 'Sukses menambah Sparepart');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sparepart  $sparepart
     * @return \Illuminate\Http\Response
     */
    public function show(Sparepart $sparepart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sparepart  $sparepart
     * @return \Illuminate\Http\Response
     */
    public function edit($sparepart)
    {
        $spareparts = DB::table('spareparts')->where('id_spareparts', $sparepart)->get(); 
        $datas2 = DB::table('outlets')
                ->select('outlets.*')
                ->get();
        $datas3 = DB::table('mesins')
                ->select('mesins.*')
                ->get();
                // dd($spareparts);
        return view('admin.sparepart.edit',compact('spareparts','datas2','datas3'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sparepart  $sparepart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $sparepart)
    {
        $request->validate([
            'nm_spareparts' => 'required',
            'gmbr_spareparts' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'kategori' => 'required',
            'spareparts_detail' => 'required',
            'id_mesins' => 'required',
            'id_outlets' => 'required'
        ]);
        $input = $request->except(['_token','_method']);
        
        if ($gmbr_spareparts = $request->file('gmbr_spareparts')) {
            $randomNumber = random_int(10, 9999);
            $destinationPath = 'image/';
            $profileImage = date('YmdHis').$randomNumber . "." . $gmbr_spareparts->getClientOriginalExtension();
            $gmbr_spareparts->move($destinationPath, $profileImage);
            $input['gmbr_spareparts'] = "$profileImage";
        }else{
            unset($input['gmbr_spareparts']);
        }
        DB::table('spareparts')
              ->where('id_spareparts', $sparepart)
              ->update($input);

        return redirect()->route('spareparts.indexAdmin')
                        ->with('edit','Outlet sukses diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sparepart  $sparepart
     * @return \Illuminate\Http\Response
     */
    public function destroy($sparepart)
    {
        DB::table('spareparts')->where('id_spareparts', $sparepart)->delete();
    
        return redirect()->back()->with('hapus', 'Berhasil menghapus Sparepart');
    }
}
