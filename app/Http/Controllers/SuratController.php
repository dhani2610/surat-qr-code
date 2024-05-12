<?php

namespace App\Http\Controllers;

use App\Exports\LaporanExport;
use App\Models\Departement;
use App\Models\KodeSurat;
use App\Models\LogAction;
use App\Models\Surat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['page_title'] = 'Management Surat';
        // $data['surat'] = Surat::orderBy('kode_surat','desc')->get();
        $dept = $request->departement;
        $jenis = $request->jenis;
        $data['surat'] = DB::table('surats')
            ->where(function($query) use ($dept,$jenis)
            {
                if ($dept != null) {
                    if ($dept != 'All') {
                        $query->where('departement', $dept);
                    }
                }
                if ($jenis != null) {
                    if ($jenis != 'All') {
                        $query->where('tipe_surat', $jenis);
                    }
                }
                if (Auth::user()->role == 'User') {
                    $query->where('id_user', Auth::user()->id);
                }

            })
            ->orderBy('id_user','asc')
            ->orderBy('no_urut','asc')
            ->get();
            
        $data['hal_surat'] = KodeSurat::orderBy('kode_surat','asc')->get();
        $data['departement'] = Departement::orderBy('name','asc')->get();

		return view('surat/surat',$data);

    }
    public function indexValidasi()
    {
        $data['page_title'] = 'Management Surat';
        $data['surat'] = Surat::where('status',1)->orderBy('kode_surat','desc')->get();
        $data['hal_surat'] = KodeSurat::orderBy('kode_surat','asc')->get();
        $data['departement'] = Departement::orderBy('name','asc')->get();

		return view('surat/surat-validasi',$data);

    }

    public function logSurat($id){
        $data['page_title'] = 'Log Surat';
        $data['log'] = LogAction::where('id_surat',$id)->orderBy('created_at','desc')->get();

		return view('surat/log',$data);
    }
    public function indexValidasiPimpinan()
    {
        $data['page_title'] = 'Management Surat';
        $data['surat'] = Surat::where('status_pimpinan',2)->orderBy('kode_surat','desc')->get();
        $data['hal_surat'] = KodeSurat::orderBy('kode_surat','asc')->get();
        $data['departement'] = Departement::orderBy('name','asc')->get();

		return view('surat/surat-validasi-pimpinan',$data);

    }

    public function updateStatus(Request $request,$id)
    {
        try {
            $new = Surat::find($id);
            $new->status = $request->status;
            if ($request->status == 2) {
                $new->status_pimpinan = 2;
            }
            $new->ket_ditolak = $request->ket_ditolak;
            $new->action_approval = Auth::user()->id;
            if ($new->save()) {
                if ($new->status == 3) {
                    $log = new LogAction();
                    $log->id_surat = $new->id;
                    $log->id_user = Auth::user()->id;
                    $log->action = 'User '.Auth::user()->name.' Menolak Data Surat '.$new->kode_surat.' dengan Alasan: '.$new->ket_ditolak;
                    $log->save();
                }else{
                    $log = new LogAction();
                    $log->id_surat = $new->id;
                    $log->id_user = Auth::user()->id;
                    $log->action = 'User '.Auth::user()->name.' Menyetujui Data Surat '.$new->kode_surat;
                    $log->save();
                }
                return redirect()->back()->with('success','Successfuly Updated Data!');
            }else{
                return redirect()->back()->with('failed','Failed Updated Data!');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed',$th->getMessage());
        }
    }
    public function updateStatusPimpinan(Request $request,$id)
    {
        try {
            $new = Surat::find($id);
            $new->status_pimpinan = $request->status;
            $new->ket_ditolak_pimpinan = $request->ket_ditolak;
            $new->action_pimpinan = Auth::user()->id;
            if ($new->save()) {
                if ($new->status_pimpinan == 4) {
                    $log = new LogAction();
                    $log->id_surat = $new->id;
                    $log->id_user = Auth::user()->id;
                    $log->action = 'User '.Auth::user()->name.' Menolak Data Surat '.$new->kode_surat.' dengan Alasan: '.$new->ket_ditolak_pimpinan;
                    $log->save();
                }else{
                    $log = new LogAction();
                    $log->id_surat = $new->id;
                    $log->id_user = Auth::user()->id;
                    $log->action = 'User '.Auth::user()->name.' Menyetujui Data Surat '.$new->kode_surat;
                    $log->save();
                }
                return redirect()->back()->with('success','Successfuly Updated Data!');
            }else{
                return redirect()->back()->with('failed','Failed Updated Data!');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed',$th->getMessage());
        }
    }
    public function ajukanSurat(Request $request,$id)
    {
        try {
            $new = Surat::find($id);
            $new->status = 1;
            $new->status_pimpinan = 1;
            if ($new->save()) {
                $log = new LogAction();
                $log->id_surat = $new->id;
                $log->id_user = Auth::user()->id;
                $log->action = 'User '.Auth::user()->name.' Mengajukan Data Surat '.$new->kode_surat;
                $log->save();
                return redirect()->back()->with('success','Successfuly Updated Data!');
            }else{
                return redirect()->back()->with('failed','Failed Updated Data!');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed',$th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    // Fungsi untuk mengonversi angka biasa menjadi angka Romawi
    private function getMonthInRomanNumerals($date)
    {
        // Ambil bulan dari tanggal yang diberikan
        $month = date('m', strtotime($date));

        // Daftar bulan dalam angka Romawi
        $monthMap = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII',
        ];

        // Mengonversi angka bulan menjadi angka Romawi menggunakan peta bulan
        return $monthMap[(int)$month];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        
        try {
            $getJenis = KodeSurat::find($request->id_jenis);
            $dept = Departement::find(Auth::user()->id_departement);
            $monthRomawi = $this->getMonthInRomanNumerals($request->month);
            $latestPelaporan = Surat::latest()->first();
            $lastNumber = $latestPelaporan ? (int)substr($latestPelaporan->no_urut, 0, 3) : 0; // Mengambil 3 digit pertama
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            $noSurat = $newNumber.'/'.$getJenis->kode_surat.'/'.$dept->kode_departement.'/'.$monthRomawi.'/'.date('Y', strtotime($request->month));
            // dd($noSurat,$request->all());
            $data = new Surat();
            $data->id_user = Auth::user()->id;
            $data->status = 1;
            $data->kode_surat = $noSurat;
            $data->no_urut = $newNumber;
            $data->perihal_surat = $request->perihal_surat;
            $data->tipe_surat = $request->tipe_surat;
            $data->id_jenis = $request->id_jenis;
            $data->no_surat = $request->no_surat;
            $data->month = $request->month;
            $data->departement = $request->departement;
            $data->status_pimpinan = 1;

            if ($data->save()) {
                $log = new LogAction();
                $log->id_surat = $data->id;
                $log->id_user = Auth::user()->id;
                $log->action = 'User '.Auth::user()->name.' Membuat Data Surat '.$data->kode_surat;
                $log->save();

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
    public function detail(Request $request)
    {
        $data['data'] = Surat::where('kode_surat',$request->kode_surat)->first();
		return view('surat/view-detail',$data);
    }
    public function share(Request $request)
    {
        $data['data'] = Surat::where('kode_surat',$request->kode_surat)->first();
		return view('surat/view-share',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Surat $surat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $getJenis = KodeSurat::find($request->id_jenis);
            $dept = Departement::find(Auth::user()->id_departement);
            $monthRomawi = $this->getMonthInRomanNumerals($request->month);
            $latestPelaporan = Surat::latest()->first();
            $lastNumber = $latestPelaporan ? (int)substr($latestPelaporan->no_urut, 0, 3) : 0; // Mengambil 3 digit pertama
            
            $data = Surat::find($id);
            $noSurat = $data->no_urut.'/'.$getJenis->kode_surat.'/'.$dept->kode_departement.'/'.$monthRomawi.'/'.date('Y', strtotime($request->month));
            $data->perihal_surat = $request->perihal_surat;
            $data->tipe_surat = $request->tipe_surat;
            $data->id_jenis = $request->id_jenis;
            $data->kode_surat = $noSurat;
            $data->no_surat = $request->no_surat;
            $data->month = $request->month;
            $data->departement = $request->departement;
            $data->month = $request->month;

            if ($data->save()) {
                $log = new LogAction();
                $log->id_surat = $data->id;
                $log->id_user = Auth::user()->id;
                $log->action = 'User '.Auth::user()->name.' Mengedit Data Surat '.$data->kode_surat;
                $log->save();

                return redirect()->back()->with('success','Successfuly Updated Data!');
            }else{
                return redirect()->back()->with('failed','Failed Updated Data!');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed',$th->getMessage());
        }
    }

    public function updateSurat(Request $request,$id){

        try {
            $data = Surat::find($id);
            // upload document 
            $dokumenval = $request->file_surat;
            if ($dokumenval != null) {
                $documentLaporanPath = public_path('surat/');
                $documentNameLaporan = $dokumenval->getClientOriginalName();
                $i = 1;
                while (file_exists($documentLaporanPath . $documentNameLaporan)) {
                    $documentNameLaporan = pathinfo($dokumenval->getClientOriginalName(), PATHINFO_FILENAME) . "($i)." . $dokumenval->getClientOriginalExtension();
                    $i++;
                }
                $dokumenval->move($documentLaporanPath, $documentNameLaporan);
                $data->file_surat = $documentNameLaporan;
            }

            if ($data->save()) {
                $log = new LogAction();
                $log->id_surat = $data->id;
                $log->id_user = Auth::user()->id;
                $log->action = 'User '.Auth::user()->name.' Mengupload Surat '.$data->kode_surat;
                $log->save();

                return redirect()->back()->with('success','Successfuly Save Data!');
            }else{
                return redirect()->back()->with('failed','Failed Save Data!');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed',$th->getMessage());
        }
          
      // end upload dokumen 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $data = Surat::find($id);

            $log = new LogAction();
            $log->id_surat = $data->id;
            $log->id_user = Auth::user()->id;
            $log->action = 'User '.Auth::user()->name.' Menghapus Data Surat '.$data->kode_surat;
            $log->save();

            if ($data->delete()) {

                return redirect()->back()->with('success','Successfuly Updated Data!');
            }else{
                return redirect()->back()->with('failed','Failed Updated Data!');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed',$th->getMessage());
        }
    }

    public function export_excel(Request $request)
    {
         // Set locale untuk menggunakan bahasa Indonesia
         Carbon::setLocale('id');

         // Buat objek Carbon dari tanggal saat ini
         $date = Carbon::now();
 
         // Format tanggal sesuai dengan format yang diinginkan
         $formattedDate = $date->isoFormat('dddd, D MMMM YYYY');
 
         // Buat nama file dengan format yang diinginkan
        $name = 'Laporan ' . $formattedDate . '.xlsx';

        return Excel::download(new LaporanExport($request->all()), $name);
    }
}
