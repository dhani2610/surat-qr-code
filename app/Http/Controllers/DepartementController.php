<?php

namespace App\Http\Controllers;

use App\Exports\LaporanExport;
use App\Models\Departement;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['page_title'] = 'Departement';
        $data['departement'] = Departement::orderBy('name','asc')->get();
		return view('departement/departement',$data);
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
            $new = new Departement();
            $new->name = $request->name;
            $new->kode_departement = $request->kode_departement;
    
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
    public function show(Departement $Departement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Departement $Departement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $new = Departement::find($id);
            $new->name = $request->name;
            $new->kode_departement = $request->kode_departement;
    
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
            $new = Departement::find($id);
    
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
