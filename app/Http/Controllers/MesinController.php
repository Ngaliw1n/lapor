<?php

namespace App\Http\Controllers;

use App\Models\Mesin;
use Illuminate\Http\Request;
use DB;

class MesinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.mesin.index');
    }

    public function indexAdmin()
    {
        // $datas = Mesin::latest()->paginate(10);
        $datas = DB::table('mesins')
                ->join('outlets','mesins.id_outlet','=','outlets.outlets_id', 'right outer')
                ->select('outlets.nm_outlet', 'outlets.outlets_id','mesins.*')
                ->groupBy('mesins.id_mesin')
                ->paginate(10);
        $datas2 = DB::table('outlets')
                ->select('outlets.*')
                ->get();
                // ->get();
        // dd($datas);
        return view('admin.mesin.index',compact('datas','datas2'));
    }

    public function cari(Request $request)
	{
		// menangkap data pencarian
		$cari = $request->cari;
    		// mengambil data dari table pegawai sesuai pencarian data
		$datas = DB::table('mesins')
                ->join('outlets','mesins.id_outlet','=','outlets.outlets_id', 'left outer')
                ->select('outlets.nm_outlet', 'outlets.outlets_id','mesins.*')
                ->groupBy('mesins.id_mesin')
		        ->where('mesins.nm_mesin','like',"%".$cari."%")
                ->paginate(10);

        $datas2 = DB::table('outlets')
                 ->select('outlets.*')
                 ->get();

        return view('admin.mesin.index',compact('datas','datas2')); 
	}

    public function detailMesin(Request $request) 
    {
        $cari = $request->cari;
        $data = DB::table('mesins')
        ->select('mesins.*')
		->where('id_mesin','=',$cari)
        ->get();

        $data2 = DB::table('kerusakan')
        ->join('perbaikan','kerusakan.id_kerusakan','=','perbaikan.id_kerusakan', 'left outer')
        ->select('kerusakan.nm_kerusakan','kerusakan.tgl', 'kerusakan.gmbr_kerusakan', 'kerusakan.detail', DB::raw('COUNT(perbaikan.id_perbaikan) as status'))
        ->groupBy('kerusakan.nm_kerusakan')
        ->where('kerusakan.id_mesins','like',"%".$cari."%")
        ->get();
        
        // dd($data2);
        return view('admin.mesin.detail', compact('data', 'data2'));
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
            'nm_mesin' => 'required',
            'id_outlet' => 'required',
            'gbr_mesin' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'tgl' => 'required'
        ]);     
    
        $input = $request->all();
        // Outlet::create($request->all());

        if ($gbr_mesin = $request->file('gbr_mesin')) {
            $randomNumber = random_int(10, 9999);
            $destinationPath = 'image/';
            $profileImage = date('YmdHis').$randomNumber . "." . $gbr_mesin->getClientOriginalExtension();
            $gbr_mesin->move($destinationPath, $profileImage);
            $input['gbr_mesin'] = "$profileImage";
        }

        Mesin::create($input);

        return redirect()->back()->with('sukses', 'Sukses menambah Mesin');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mesin  $mesin
     * @return \Illuminate\Http\Response
     */
    public function show(Mesin $mesin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mesin  $mesin
     * @return \Illuminate\Http\Response
     */
    public function edit($mesin)
    {
        $mesins = DB::table('mesins')->where('id_mesin', $mesin)->get(); 
        $datas2 = DB::table('outlets')
                ->select('outlets.*')
                ->get();

                // dd($mesins);
        return view('admin.mesin.edit',compact('mesins','datas2'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mesin  $mesin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $mesin)
    {
        $request->validate([
            'nm_mesin' => 'required',
            'id_outlet' => 'required',
            'gbr_mesin' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'tgl' => 'required'
        ]);
        $input = $request->except(['_token','_method']);
        
        if ($gbr_mesin = $request->file('gbr_mesin')) {
            $randomNumber = random_int(10, 9999);
            $destinationPath = 'image/';
            $profileImage = date('YmdHis').$randomNumber . "." . $gbr_mesin->getClientOriginalExtension();
            $gbr_mesin->move($destinationPath, $profileImage);
            $input['gbr_mesin'] = "$profileImage";
        }else{
            unset($input['gbr_mesin']);
        }
        DB::table('mesins')
              ->where('id_mesin', $mesin)
              ->update($input);

        return redirect()->route('mesins.indexAdmin')
                        ->with('edit','Outlet sukses diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mesin  $mesin
     * @return \Illuminate\Http\Response
     */
    public function destroy($mesin)
    {
        DB::table('mesins')->where('id_mesin', $mesin)->delete();
    
        return redirect()->back()->with('hapus', 'Berhasil menghapus Mesin');
    }
}
