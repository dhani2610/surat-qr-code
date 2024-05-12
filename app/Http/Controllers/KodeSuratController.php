<?php

namespace App\Http\Controllers;

use App\Models\KodeSurat;
use Illuminate\Http\Request;

class KodeSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['page_title'] = 'Hal Surat';
        $data['kode'] = KodeSurat::orderBy('kode_surat','asc')->get();
        // dd($data);
		return view('kode_surat/kode_surat',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $new = new KodeSurat();
            $new->jenis = $request->jenis_surat;
            $new->kode_surat = $request->kode_surat;
    
            if ($new->save()) {
                return redirect()->back()->with('success','Successfuly Created Data!');
            }else{
                return redirect()->back()->with('failed','Failed Created Data!');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed',$th->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(KodeSurat $KodeSurat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KodeSurat $KodeSurat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $new = KodeSurat::find($id);
            $new->jenis = $request->jenis_surat;
            $new->kode_surat = $request->kode_surat;
    
            if ($new->save()) {
                return redirect()->back()->with('success','Successfuly Updated Data!');
            }else{
                return redirect()->back()->with('failed','Failed Updated Data!');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed',$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $new = KodeSurat::find($id);
    
            if ($new->delete()) {
                return redirect()->back()->with('success','Successfuly Deleted Data!');
            }else{
                return redirect()->back()->with('failed','Failed Deleted Data!');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed',$th->getMessage());
        }
    }
}
