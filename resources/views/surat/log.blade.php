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
                                        Log 
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tanggal Waktu 
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($log as $item)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $item->action }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $item->created_at }}</p>
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
    if ($(this).val() === '3') {
        $('.keterangan-div').show();
    } else {
        $('.keterangan-div').hide();
    }
}

    $(document).ready(function () {
        $('.keterangan-div-create').hide();
        // Tambahkan event listener untuk memantau perubahan pada dropdown
        $('select[name="status"]').change(function() {
            if ($(this).val() === '3') {
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