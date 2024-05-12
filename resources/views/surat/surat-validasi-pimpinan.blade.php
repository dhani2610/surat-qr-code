@extends('layouts.user_type.auth')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div>
 
    @if($errors->any())
        <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
            <span class="alert-text text-white">
            {{$errors->first()}}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </button>
        </div>
    @endif
    @if(session('success'))
        <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
            <span class="alert-text text-white">
            {{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </button>
        </div>
    @endif
    @if(session('failed'))
        <div class="m-3  alert alert-danger alert-dismissible fade show" id="alert-danger" role="alert">
            <span class="alert-text text-white">
            {{ session('failed') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </button>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0 mb-2">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">{{ $page_title }}</h5>
                        </div>
                
                    </div>
                </div>
                <div class="card-body px-3 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table id="myDataTable" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Pembuat
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Kode Surat
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Jenis Surat
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Perihal Surat
                                    </th>
                                    
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        No Surat
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Hal Surat
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tujuan Departement
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($surat as $item)
                                <tr>
                                    <td onclick="window.location.href = '{{ route('log',$item->id) }}'"class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                    </td>
                                    <td onclick="window.location.href = '{{ route('log',$item->id) }}'"class="text-center">
                                        @php
                                            $pembuat = App\Models\User::where('id',$item->id_user)->first();
                                        @endphp
                                        <p class="text-xs font-weight-bold mb-0">{{ $pembuat->name ?? '-' }}</p>
                                    </td>
                                    <td onclick="window.location.href = '{{ route('log',$item->id) }}'"class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $item->kode_surat }}</p>
                                    </td>
                                    <td onclick="window.location.href = '{{ route('log',$item->id) }}'"class="text-center">
                                        @if ($item->tipe_surat == 1)
                                        <p class="text-xs font-weight-bold mb-0">Surat Masuk</p>
                                        @else
                                        <p class="text-xs font-weight-bold mb-0">Surat Keluar</p>
                                        @endif
                                    </td>
                                    <td onclick="window.location.href = '{{ route('log',$item->id) }}'"class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $item->perihal_surat }}</p>
                                    </td>
                                    <td onclick="window.location.href = '{{ route('log',$item->id) }}'"class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $item->no_surat }}</p>
                                    </td>
                                    <td onclick="window.location.href = '{{ route('log',$item->id) }}'"class="text-center">
                                        @php
                                            $jd = App\Models\KodeSurat::where('id',$item->id_jenis)->first();
                                        @endphp
                                        <p class="text-xs font-weight-bold mb-0">{{ $jd->jenis ?? '-' }}</p>
                                    </td>
                                    <td onclick="window.location.href = '{{ route('log',$item->id) }}'"class="text-center">
                                        @php
                                            $dp = App\Models\Departement::where('id',$item->departement)->first();
                                        @endphp
                                        <p class="text-xs font-weight-bold mb-0">{{ $dp->name ?? '-' }}</p>
                                    </td>
                                    <td onclick="window.location.href = '{{ route('log',$item->id) }}'">
                                        @if ($item->status_pimpinan == 1)
                                            <span class="badge bg-warning" data-bs-toggle="tooltip">Menunggu Proses Validasi Approval</span>
                                        @elseif ($item->status_pimpinan == 2)
                                            <span class="badge bg-warning" data-bs-toggle="tooltip">Dalam Proses Validasi</span>
                                        @elseif ($item->status_pimpinan == 3)
                                            <span class="badge bg-success">Disetujui</span>
                                        @else
                                            <span class="badge bg-danger">Ditolak</span>
                                            <a href="#" type="button" title="Klik untuk lihat reason pimpinan!" data-bs-toggle="modal" data-bs-target="#reasonPimpinan{{ $item->id }}">
                                                <i class="fas fa-edit	text-secondary"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="#" type="button"  data-bs-toggle="modal" data-bs-target="#modalDokumen{{ $item->id }}">
                                            <i class="fa fa-file-text"></i>
                                        </a>
                                        <a href="#" type="button" onclick="editStatus('{{$item->status}}')" data-bs-toggle="modal" data-bs-target="#modaledit{{ $item->id }}">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@foreach ($surat as $item2)
<div class="modal fade" id="modalDokumen{{ $item2->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">File Surat</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form role="form text-left" method="POST" action="{{ route('update-file',$item2->id) }}" enctype="multipart/form-data">
            @csrf
        <div class="modal-body">
                @csrf
            <div class="mb-3">
                <label for="">File Surat</label> <br>
                @if ($item2->file_surat != null)
                    <a href="{{ asset('surat/'.$item2->file_surat) }}"><i class="fa fa-file-text"></i> {{$item2->file_surat}}</a>
                @endif
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </form>
        </div>
    </div>
    </div>
</div>
<div class="modal fade" id="modaledit{{ $item2->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Status {{ $item2->name }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form role="form text-left" method="POST" action="{{ route('updateStatusPimpinan',$item2->id) }}" enctype="multipart/form-data">
            @csrf
        <div class="modal-body">
                @csrf
                <div class="mb-3">
                    <label for="">Status</label>
                    <select name="status" class="form-control" id="" required>
                        <option value="3">Diterima</option>
                        <option value="4">Ditolak</option>
                    </select>
                    @error('status')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3 keterangan-div" >
                    <label for="">Keterangan</label> 
                    <textarea name="ket_ditolak" class="form-control" id="" cols="30" rows="10"></textarea>
                @error('reason_non_aktif')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
                </div>
        </div>
        
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
        </div>
    </div>
    </div>
</div>
@endforeach



<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
function printQR(kode) {
    console.log(kode);
    var kodeqr = 'qr-code-'+kode;
    var printContents = document.getElementById(kodeqr).outerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}

function editStatus(id){
    console.log('====================================');
    console.log(id);
    console.log('====================================');
    // Sembunyikan div saat halaman dimuat
    if (id == 3) {
        $('.keterangan-div').show();
    }else{
        $('.keterangan-div').hide();
    }

    // Tambahkan event listener untuk memantau perubahan pada dropdown
    if ($(this).val() === '4') {
        $('.keterangan-div').show();
    } else {
        $('.keterangan-div').hide();
    }
}

    $(document).ready(function () {
        $('.keterangan-div-create').hide();
        // Tambahkan event listener untuk memantau perubahan pada dropdown
        $('select[name="status"]').change(function() {
            if ($(this).val() === '4') {
                $('.keterangan-div').show();
            } else {
                $('.keterangan-div').hide();
            }
        });

    });
</script>



<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$('.select2').select2();
$('.dropify').dropify();

    $(document).ready(function () {
        $('#myDataTable').DataTable();
    });
</script>

@endsection