<table style="border: 1px solid black;text-align:center;">
    <thead>
        <tr style="border: 1px solid black;text-align:center;background:orange">
            <td colspan="12" style="text-align:center;"> <b>LAPORAN DATA SURAT</b></td>
        </tr>
        <tr>
            <th style="border: 1px solid black;text-align:center;">No</th>
            <th style="border: 1px solid black;text-align:center;">User</th>
            <th style="border: 1px solid black;text-align:center;">Username</th>
            <th style="border: 1px solid black;text-align:center;">No Handpone</th>
            <th style="border: 1px solid black;text-align:center;">Email</th>
            <th style="border: 1px solid black;text-align:center;">Password</th>
            <th style="border: 1px solid black;text-align:center;">Perihal Surat</th>
            <th style="border: 1px solid black;text-align:center;">Kode Surat</th>
            <th style="border: 1px solid black;text-align:center;">No Surat</th>
            <th style="border: 1px solid black;text-align:center;">Jenis Surat</th>
            <th style="border: 1px solid black;text-align:center;">Hal Surat</th>
            <th style="border: 1px solid black;text-align:center;">Tujuan Departement</th>
            <th style="border: 1px solid black;text-align:center;">Link Surat</th>
            <th style="border: 1px solid black;text-align:center;">User Approval</th>
            <th style="border: 1px solid black;text-align:center;">User Approval Pimpinan</th>
            <th style="border: 1px solid black;text-align:center;">Status Approval</th>
            <th style="border: 1px solid black;text-align:center;">Keterangan Ditolak Approval</th>
            <th style="border: 1px solid black;text-align:center;">Status Approval Pimpinan</th>
            <th style="border: 1px solid black;text-align:center;">Keterangan Ditolak Pimpinan</th>
        </tr>
    </thead>
    <tbody>
        @php $prev_user = null; $row_span = 0;$noUrut = 1 @endphp
        @foreach ($data as $key => $item)
            @php
                $pembuat = App\Models\User::where('id', $item->id_user)->first();
            @endphp
            <tr>
            @if ($prev_user != $pembuat->id)
                @php $row_span = $data->where('id_user', $pembuat->id)->count(); @endphp
                    <td rowspan="{{ $row_span }}" style="border: 1px solid black;text-align:center;" class="text-center">
                        <p class="text-xs font-weight-bold mb-0">{{ $noUrut++ }}</p>
                    </td>
                    <td rowspan="{{ $row_span }}" style="border: 1px solid black;text-align:center;" class="text-center">
                        <p class="text-xs font-weight-bold mb-0">{{ $pembuat->name ?? '-' }}</p>
                    </td>
                    <td rowspan="{{ $row_span }}" style="border: 1px solid black;text-align:center;" class="text-center">
                        <p class="text-xs font-weight-bold mb-0">{{ $pembuat->stambuk ?? '-' }}</p>
                    </td>
                    <td rowspan="{{ $row_span }}" style="border: 1px solid black;text-align:center;" class="text-center">
                        <p class="text-xs font-weight-bold mb-0">{{ $pembuat->phone ?? '-' }}</p>
                    </td>
                    <td rowspan="{{ $row_span }}" style="border: 1px solid black;text-align:center;" class="text-center">
                        <p class="text-xs font-weight-bold mb-0">{{ $pembuat->email ?? '-' }}</p>
                    </td>
                    <td rowspan="{{ $row_span }}" style="border: 1px solid black;text-align:center;" class="text-center">
                        <p class="text-xs font-weight-bold mb-0">{{ $pembuat->pw_text ?? '-' }}</p>
                    </td>
            @endif
                    <td style="border: 1px solid black;text-align:center;" class="text-center">
                        <p class="text-xs font-weight-bold mb-0">{{ $item->perihal_surat }}</p>
                    </td>
                    <td style="border: 1px solid black;text-align:center;" class="text-center">
                        <p class="text-xs font-weight-bold mb-0">{{ $item->kode_surat }}</p>
                    </td>
                    <td style="border: 1px solid black;text-align:center;" class="text-center">
                        <p class="text-xs font-weight-bold mb-0">{{ $item->no_surat }}</p>
                    </td>
                    <td style="border: 1px solid black;text-align:center;" class="text-center">
                        @if ($item->tipe_surat == 1)
                        <p class="text-xs font-weight-bold mb-0">Surat Masuk</p>
                        @else
                        <p class="text-xs font-weight-bold mb-0">Surat Keluar</p>
                        @endif
                    </td>
                   
                    <td style="border: 1px solid black;text-align:center;"  class="text-center">
                        @php
                            $jd = App\Models\KodeSurat::where('id',$item->id_jenis)->first();
                        @endphp
                        <p class="text-xs font-weight-bold mb-0">{{ $jd->jenis ?? '-' }}</p>
                    </td>
                    <td style="border: 1px solid black;text-align:center;"  class="text-center">
                        @php
                            $dp = App\Models\Departement::where('id',$item->departement)->first();
                        @endphp
                        <p class="text-xs font-weight-bold mb-0">{{ $dp->name ?? '-' }}</p>
                    </td>
                    <td style="border: 1px solid black;text-align:center;" class="text-center">
                        @if ($item->file_surat != null)
                            <a href="{{ env('APP_URL').'/view-detail?kode_surat='.$item->kode_surat }}">{{ env('APP_URL').'/view-detail?kode_surat='.$item->kode_surat }} </a>
                        @endif
                    </td>
                    <td style="border: 1px solid black;text-align:center;" class="text-center">
                        @if ($item->action_approval != null)
                            @php
                                $userApproval = App\Models\User::where('id',$item->action_approval)->first();
                            @endphp
                            {{ $userApproval->name ?? '-' }}
                        @endif
                    </td>
                    <td style="border: 1px solid black;text-align:center;" class="text-center">
                        @if ($item->action_pimpinan != null)
                            @php
                                $userApprovalPimpinan = App\Models\User::where('id',$item->action_pimpinan)->first();
                            @endphp
                            {{ $userApprovalPimpinan->name ?? '-' }}
                        @endif
                    </td>
                    <td style="border: 1px solid black;text-align:center;" class="text-center">
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
                    <td style="border: 1px solid black;text-align:center;" class="text-center">
                        @if ($item->status == 3)
                            <p class="text-xs font-weight-bold mb-0">{{ $item->ket_ditolak }}</p>
                        @endif
                    </td>
                    <td style="border: 1px solid black;text-align:center;" class="text-center">
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
                    <td style="border: 1px solid black;text-align:center;" class="text-center">
                        @if ($item->status_pimpinan == 4)
                            <p class="text-xs font-weight-bold mb-0">{{ $item->ket_ditolak_pimpinan }}</p>
                        @endif
                    </td>
                
            @if ($prev_user != $pembuat->id)
                </tr>
            @endif
            @php $prev_user = $pembuat->id; @endphp
        @endforeach
    </tbody>
</table>
