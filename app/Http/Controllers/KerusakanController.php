<?php

namespace App\Http\Controllers;

use App\Models\Kerusakan;
use Illuminate\Http\Request;
use DB;

class KerusakanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $datas = DB::table('kerusakan')
        //         ->join('mesins','kerusakan.id_mesins','=','mesins.id_mesin', 'right outer')
        //         ->join('outlets','kerusakan.id_outlets','=','outlets.outlets_id', 'right outer')
        //         ->join('users','kerusakan.id_pelapor','=','users.id', 'right outer')              
        //         ->select('mesins.id_mesin','mesins.nm_mesin','outlets.outlets_id','outlets.nm_outlet', 'users.id','users.name','perbaikan.*')
        //         ->groupBy('kerusakan.id_kerusakan')
        //         ->paginate(10);
        // dd($datas);
    }
    public function indexAdmin()
    {
        $datas = DB::table('kerusakan')
                ->join('mesins','kerusakan.id_mesins','=','mesins.id_mesin', 'right outer')
                ->join('outlets','kerusakan.id_outlet','=','outlets.outlets_id', 'right outer')
                ->join('users','kerusakan.id_pelapor','=','users.id', 'right outer')              
                ->select('mesins.id_mesin','mesins.nm_mesin','outlets.outlets_id','outlets.nm_outlet', 'users.id','users.name','kerusakan.*')
                ->groupBy('kerusakan.id_kerusakan')
                ->paginate(10);
        // dd($datas);
        $datas2 = DB::table('outlets')
                ->select('outlets.*')
                ->get();
                
        $datas3 = DB::table('mesins')
                ->select('mesins.*')
                ->get();

        $datas4 = DB::table('users')
                ->select('users.*')
                ->get();

        return view('admin.kerusakan.index',compact('datas','datas2','datas3','datas4'));
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
            'nm_kerusakan' => 'required',
            'tgl' => 'required',
            'gmbr_kerusakan' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'detail' => 'required',
            'id_mesins' => 'required',
            'id_outlet' => 'required',
            'id_pelapor' => 'required'
        ]);     
    
        $input = $request->all();
        // Outlet::create($request->all());

        if ($gmbr_kerusakan = $request->file('gmbr_kerusakan')) {
            $randomNumber = random_int(10, 9999);
            $destinationPath = 'image/';
            $profileImage = date('YmdHis').$randomNumber . "." . $gmbr_kerusakan->getClientOriginalExtension();
            $gmbr_kerusakan->move($destinationPath, $profileImage);
            $input['gmbr_kerusakan'] = "$profileImage";
        }

        Kerusakan::create($input);

        return redirect()->back()->with('sukses', 'Sukses menambah Mesin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
