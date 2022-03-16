<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use Illuminate\Http\Request;
use DataTables;
use DB;

class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /* Admin */
    public function indexAdmin()
    {
        $datas = DB::table('outlets')
                ->join('mesins','outlets.outlets_id','=','mesins.id_outlet', 'left outer')
                ->select('outlets.outlets_id', 'outlets.nm_outlet', 'outlets.detail',DB::raw('COUNT(mesins.id_mesin) AS jml_mesin'))
                ->groupBy('outlets.outlets_id')
                ->paginate(10);
                // ->get();/
        // dd($datas);
        return view('admin.outlet.index',['datas' => $datas]);
    }

    public function cari(Request $request)
	{
		// menangkap data pencarian
		$cari = $request->cari;
    		// mengambil data dari table pegawai sesuai pencarian data
		$datas = DB::table('outlets')
                 ->join('mesins','outlets.outlets_id','=','mesins.id_outlet', 'left outer')
                ->select('outlets.outlets_id', 'outlets.nm_outlet', 'outlets.detail',DB::raw('COUNT(mesins.id_mesin) AS jml_mesin'))
                ->groupBy('outlets.outlets_id')
		        ->where('outlets.nm_outlet','like',"%".$cari."%")
                ->paginate(10);

        return view('admin.outlet.index',['datas' => $datas]); 
	}

    public function detailOutlet(Request $request) 
    {
        $cari = $request->cari;
        $data = DB::table('outlets')
        ->join('mesins','outlets.outlets_id','=','mesins.id_outlet','left outer')
        ->select('outlets.*', 'mesins.*')
		->where('outlets.outlets_id','=',$cari)
        ->get();
        
        // dd($data);
        return view('admin.outlet.detail', compact('data'));
    }
    // public function getOutlets(Request $request)
    // { 
    //     if ($request->ajax()) {
    //         // $data = Outlet::All();
    //         // $data = Outlet::join('mesins','outlets.id','=','mesins.id')
    //         //         ->select(['outlets.id', 'outlets.nm_outlet', 'outlets.detail', DB::raw('count(mesins.id_outlet) as jml_mesin')])
    //         //         ->groupBy(1)
    //         //         ->get();
    //         // SELECT outlets.id, outlets.nm_outlet, outlets.detail, COUNT(mesins.id_outlet) as jml_mesin FROM outlets INNER JOIN mesins ON outlets.id = mesins.id_outlet GROUP by 1;
            
    //         //TODO fix count
    //         $data = DB::table('outlets')
    //                 ->select('outlets.id', 'outlets.nm_outlet', 'outlets.detail')
    //                 ->selectRaw('COUNT(mesins.id_mesin) as jml_mesin')
    //                 ->join('mesins','outlets.id','=','mesins.id_mesin')
    //                 ->groupBy('outlets.id')
    //                 ->get();
    //         // dd($data);
    //         return Datatables::of($data)
    //             ->addIndexColumn()
    //             ->addColumn('action', function($row){
    //                 $actionBtn = '
    //                 <a href="javascript:void(0)" class="edit btn btn-primary btn-sm">
    //                     <div class="sb-nav-link-icon">
    //                         <i class="fa fa-eye"></i>
    //                     </div>
    //                 </a> 
    //                 <a href="javascript:void(0)" class="edit btn btn-success btn-sm">
    //                     <div class="sb-nav-link-icon">
    //                         <i class="fa fa-edit"></i>
    //                     </div>
    //                 </a> 
    //                 <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">
    //                     <div class="sb-nav-link-icon">
    //                         <i class="fa fa-minus"></i>
    //                     </div>
    //                 </a>';
    //                 return $actionBtn;
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }
    // }

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
            'nm_outlet' => 'required',
            'detail' => 'required',
            'gmbr_outlet' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);     
    
        $input = $request->all();
        // Outlet::create($request->all());

        if ($gmbr_outlet = $request->file('gmbr_outlet')) {
            $randomNumber = random_int(10, 9999);
            $destinationPath = 'image/';
            $profileImage = date('YmdHis').$randomNumber. "." . $gmbr_outlet->getClientOriginalExtension();
            $gmbr_outlet->move($destinationPath, $profileImage);
            $input['gmbr_outlet'] = "$profileImage";
        }

        Outlet::create($input);

        return redirect()->back()->with('sukses', 'Sukses menambah Outlet');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function show(Outlet $outlet)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function edit(Outlet $outlet)
    {
        return view('admin.outlet.edit',compact('outlet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outlet $outlet)
    {
        $request->validate([
            'nm_outlet' => 'required',
            'detail' => 'required',
            'gmbr_outlet' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);
        $input = $request->all();
        
        if ($gmbr_outlet = $request->file('gmbr_outlet')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $gmbr_outlet->getClientOriginalExtension();
            $gmbr_outlet->move($destinationPath, $profileImage);
            $input['gmbr_outlet'] = "$profileImage";
        }else{
            unset($input['gmbr_outlet']);
        }
        
        $outlet->update($input);
    
        return redirect()->route('outlet.indexAdmin')
                        ->with('edit','Outlet sukses diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function destroy($outlet)
    {
        DB::table('outlets')->where('outlets_id', $outlet)->delete();
    
        return redirect()->back()->with('hapus', 'Berhasil menghapus Akun');
    }

    /* akhir admin */
}
