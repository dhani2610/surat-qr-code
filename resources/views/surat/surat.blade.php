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
                    <a href="#" class="btn bg-gradient-primary btn-sm mb-0" type="button" data-bs-toggle="modal" data-bs-target="#filter">Filter </a>
                    @if (Auth::user()->role == 'Superadmin' || Auth::user()->role == 'Admin' )
                    <a href="#" class="btn bg-gradient-success btn-sm mb-0" type="button" data-bs-toggle="modal" data-bs-target="#laporan   ">Laporan </a>
                    @endif

                    <div class="modal fade" id="filter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Setting</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form role="form text-left" method="get" action="" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="mb-3">
                                    @php
                                        $dept = Request::get('departement');
                                        $jenis = Request::get('jenis');
                                    @endphp
                                    <label for="">Departement</label>
                                    <select name="departement" class="form-control"  id="">
                                        <option value="">Pilih Departement</option>
                                        <option value="All">Semua Departement</option>
                                        @foreach ($departement as $dp)
                                            <option value="{{ $dp->id }}" {{ $dept == $dp->id ? 'selected' : '' }}>{{ $dp->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="">Jenis Surat</label>
                                    <select name="jenis" class="form-control"  id="">
                                        <option value="">Pilih Jenis Surat</option>
                                        <option value="All" {{ $jenis == 'All' ? 'selected' : '' }}>Semua Jenis Surat</option>
                                        <option value="1" {{ $jenis == '1' ? 'selected' : '' }}>Surat Masuk</option>
                                        <option value="2" {{ $jenis == '2' ? 'selected' : '' }}>Surat Keluar</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </form>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="modal fade" id="laporan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Laporan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form role="form text-left" method="get" action="{{ route('laporan') }}" enctype="multipart/form-data">
                                @csrf
                            <div class="modal-body">
                                    @csrf
                                <div class="mb-3">
                                    @php
                                        $dept = Request::get('departement');
                                        $jenis = Request::get('jenis');
                                    @endphp
                                    <label for="">Departement</label>
                                    <select name="departement" class="form-control"  id="">
                                        <option value="">Pilih Departement</option>
                                        <option value="All">Semua Departement</option>
                                        @foreach ($departement as $dp)
                                            <option value="{{ $dp->id }}" {{ $dept == $dp->id ? 'selected' : '' }}>{{ $dp->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="">Jenis Surat</label>
                                    <select name="jenis" class="form-control"  id="">
                                        <option value="">Pilih Jenis Surat</option>
                                        <option value="All" {{ $jenis == 'All' ? 'selected' : '' }}>Semua Jenis Surat</option>
                                        <option value="1" {{ $jenis == '1' ? 'selected' : '' }}>Surat Masuk</option>
                                        <option value="2" {{ $jenis == '2' ? 'selected' : '' }}>Surat Keluar</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Download</button>
                        </form>
                            </div>
                        </div>
                        </div>
                    </div>
                    
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">{{ $page_title }}</h5>
                        </div>
                        <a href="#" class="btn bg-gradient-primary btn-sm mb-0" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">+&nbsp; Tambah {{ $page_title }}</a>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">New {{ $page_title }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form role="form text-left" method="POST" action="{{ route('tambah-surat') }}" enctype="multipart/form-data">
                                    @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="">Jenis Surat</label>
                                        <select name="tipe_surat" class="form-control" required id="">
                                            <option value="">Pilih Jenis Surat</option>
                                            <option value="1">Surat Masuk</option>
                                            <option value="2">Surat Keluar</option>
                                        </select>
                                        @error('tipe_surat')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Perihal Surat</label>
                                        <input type="text" class="form-control" placeholder="Perihal Surat" name="perihal_surat" id="perihal_surat" aria-label="perihal_surat" aria-describedby="perihal_surat" value="{{ old('perihal_surat') }}">
                                        @error('perihal_surat')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Hal Surat</label>
                                        <select name="id_jenis" class="form-control" required id="">
                                            <option value="">Pilih Hal Surat</option>
                                            @foreach ($hal_surat as $hs)
                                                <option value="{{ $hs->id }}">{{ $hs->jenis.' | '.$hs->kode_surat }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_jenis')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="">No Surat</label>
                                        <input type="text" class="form-control" placeholder="No Surat" name="no_surat" id="no_surat" aria-label="no_surat" aria-describedby="no_surat" value="{{ old('no_surat') }}">
                                        @error('no_surat')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Bulan Tahun</label>
                                        <input type="month" class="form-control" placeholder="Bulan Tahun" name="month" id="month" aria-label="month" aria-describedby="month" value="{{ old('month') }}">
                                        @error('month')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Tujuan</label>
                                        <select name="departement" class="form-control" required id="">
                                            <option value="">Pilih Departement</option>
                                            @foreach ($departement as $dp)
                                                <option value="{{ $dp->id }}">{{ $dp->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('id_jenis')
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
                                        Status Approval
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status Approval Pimpinan
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        QR CODE
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
                                    <td >
                                        @if ($item->status == 1)
                                            <span class="badge bg-warning" data-bs-toggle="tooltip">Dalam Proses Validasi</span>
                                        @elseif ($item->status == 2)
                                            <span class="badge bg-success">Disetujui</span>
                                        @else
                                            <span class="badge bg-danger">Ditolak</span>
                                            <a href="#" type="button" title="Klik untuk lihat reason!" data-bs-toggle="modal" data-bs-target="#reason{{ $item->id }}">
                                                <i class="fas fa-edit	text-secondary"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td >
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
                                    <td onclick="window.location.href = '{{ route('log',$item->id) }}'">
                                        @if ($item->status_pimpinan == 3)
                                        <a href="#" onclick="printQR('{{ $item->kode_surat }}')">
                                        <div class="qr-code" id="qr-code-{{ $item->kode_surat }}" >
                                            {!! QrCode::size(100)->generate(env('APP_URL').'/view-detail?kode_surat='.$item->kode_surat) !!}
                                        </div>
                                        </a>
                                        @else
                                        -
                                        @endif
                                        {{-- <input type="text" id="copy-{{ $item->kode_surat }}" value="{{ env('APP_URL').'/share-qr?kode_surat='.$item->kode_surat }}"> --}}
                                    </td>
                                    <td class="text-center">
                                    <a href="#" type="button" title="Share QR CODE" onclick="copy('{{ env('APP_URL').'/share-qr?kode_surat='.$item->kode_surat }}')">
                                        <i class="fa fa-share-alt" ></i>
                                    </a>
                                    <a href="#" type="button" title="File Surat"  data-bs-toggle="modal" data-bs-target="#modalDokumen{{ $item->id }}">
                                        <i class="fa fa-file-text"></i>
                                    </a>
                                    <a href="#" type="button" title="Edit Surat" data-bs-toggle="modal" data-bs-target="#modaledit{{ $item->id }}">
                                        <i class="fas fa-user-edit text-secondary"></i>
                                    </a>
                                    <a  title="Delete Surat" href="{{ route('delete-surat',$item->id) }}" type="button" >
                                        <i class="cursor-pointer fas fa-trash text-secondary"></i>
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
<div class="modal fade" id="modaledit{{ $item2->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit {{ $page_title }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form role="form text-left" method="POST" action="{{ route('update-surat',$item2->id) }}" enctype="multipart/form-data">
            @csrf
        <div class="modal-body">
                @csrf
                <div class="mb-3">
                    <label for="">Jenis Surat</label>
                    <select name="tipe_surat" class="form-control" required id="">
                        <option value="">Pilih Jenis Surat</option>
                        <option value="1" {{ $item2->tipe_surat == '1' ? 'selected' : '' }}>Surat Masuk</option>
                        <option value="2" {{ $item2->tipe_surat == '2' ? 'selected' : '' }}>Surat Keluar</option>
                    </select>
                    @error('tipe_surat')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Perihal Surat</label>
                    <input type="text" class="form-control" placeholder="Perihal Surat" name="perihal_surat" id="perihal_surat" aria-label="perihal_surat" aria-describedby="perihal_surat" value="{{ old('perihal_surat') ?? $item2->perihal_surat }}">
                    @error('perihal_surat')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Hal Surat</label>
                    <select name="id_jenis" class="form-control" required id="">
                        <option value="">Pilih Hal Surat</option>
                        @foreach ($hal_surat as $hs)
                            <option value="{{ $hs->id }}" {{ $item2->id_jenis == $hs->id ? 'selected' : '' }}>{{ $hs->jenis.' | '.$hs->kode_surat }}</option>
                        @endforeach
                    </select>
                    @error('id_jenis')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">No Surat</label>
                    <input type="text" class="form-control" placeholder="No Surat" name="no_surat" id="no_surat" aria-label="no_surat" aria-describedby="no_surat" value="{{ old('no_surat') ?? $item2->no_surat }}">
                    @error('no_surat')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Bulan Tahun</label>
                    <input type="month" class="form-control" placeholder="Bulan Tahun" name="month" id="month" aria-label="month" aria-describedby="month" value="{{ old('month') ?? $item2->month  }}">
                    @error('month')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Tujuan</label>
                    <select name="departement" class="form-control" required id="">
                        <option value="">Pilih Departement</option>
                        @foreach ($departement as $dp)
                            <option value="{{ $dp->id }}" {{ $item2->departement == $dp->id ? 'selected' : '' }}>{{ $dp->name}}</option>
                        @endforeach
                    </select>
                    @error('id_jenis')
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
                <input type="file" class="form-control" name="file_surat" id="file_surat" aria-label="file_surat" aria-describedby="file_surat" value="{{ old('file_surat') ?? $item2->file_surat }}">
                @if ($item2->status_pimpinan == 3)
                    <small style="color: red;font-size:10px">*Pastikan Surat tersebut sudah terdapat QRCODE Jika sudah disetujui oleh pimpinan!</small>
                @endif
                @error('file_surat')
                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
                <br>
                @if ($item2->file_surat != null)
                    <a href="{{ asset('surat/'.$item2->file_surat) }}"><i class="fa fa-file-text"></i> {{$item2->file_surat}}</a>
                @endif
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



<div class="modal fade" id="reason{{ $item2->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Status Ditolak</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            @csrf
        <div class="modal-body">
            <span> <b>User Approval:</b> </span> <br>
            @php
                $userApproval = App\Models\User::where('id',$item->action_approval)->first();
            @endphp
            {{ $userApproval->name ?? '-' }}
            <br>
            <span> <b>Keterangan Ditolak:</b> </span> <br>
             {{ $item2->ket_ditolak ?? 'Tidak ada keterangan' }}
        </div>
        
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a href="{{ route('ajukan-kembali',$item2->id) }}" type="button" class="btn btn-success" >Ajukan Kembali</a>
        </div>
    </div>
    </div>
</div>


<div class="modal fade" id="reasonPimpinan{{ $item2->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Status Ditolak Pimpinan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            @csrf
        <div class="modal-body">
            <span> <b>User Approval:</b> </span> <br>
            @php
                $userApprovalPimpinan = App\Models\User::where('id',$item->action_pimpinan)->first();
            @endphp
            {{ $userApprovalPimpinan->name ?? '-' }}
            <br>
            <span> <b>Keterangan Ditolak:</b> </span> <br>
             {{ $item2->ket_ditolak_pimpinan ?? 'Tidak ada keterangan' }}
        </div>
        
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a href="{{ route('ajukan-kembali',$item2->id) }}" type="button" class="btn btn-success" >Ajukan Kembali</a>
        </div>
    </div>
    </div>
</div>
@endforeach


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

    function copy(link) {
     
        // Copy the text inside the text field
        navigator.clipboard.writeText(link);
        
        // Alert the copied text
        alert("Copied link QR: " + link);
    }
</script>

@endsection