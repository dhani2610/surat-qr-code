<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail</title>

    <Style>
        @import url("https://fonts.googleapis.com/css2?family=Corben&family=Mulish&family=Outfit&family=Raleway:wght@300&display=swap");

body {
  width: auto;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-datas: center;
  margin: 0px;
  background: #d3dfed!important;
}

    </Style>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
  <div class="card mx-auto my-auto" style="border-radius: 10px;">
    <div class="card-body">
        <div class="centered">
              {!! QrCode::size(290)->generate(env('APP_URL').'/view-detail?kode_surat='.$data->kode_surat) !!} <br>
          </div>
          <div class="text">
            <br>
            <p id="one" style="font-weight: 800;font-size:15px;text-align:center">
              Kode Surat : {{$data->kode_surat}}
            </p>
          </div>
            <div class="text">
                <p id="two" style="float: left">
                  <b>
                    Perihal Surat :
                  </b>  
                  {{ $data->perihal_surat }} 
                </p>
            </div>
            <div class="text">
                <p id="two" style="float: left">
                    @php
                        $dp = App\Models\Departement::where('id',$data->departement)->first();
                    @endphp
                  <b>
                    Tujuan Departement : 
                  </b>  
                  {{ $dp->name ?? '-' }}
                </p>
            </div>
            <div class="text">
                <p id="two" style="float: left">
                  <b>
                    File Surat : 
                  </b> 
                  @if ($data->file_surat != null)
                  <a href="{{ asset('surat/'.$data->file_surat) }}" download><i class="fa fa-file-text"></i>Download</a>
                  @else
                  -
                  @endif
                </p>
            </div>  
            <div class="text">
                <p id="two" style="float: left">
                  <b>
                    User Approval : 
                  </b> 
                  @if ($data->action_approval != null)
                      @php
                          $userApproval = App\Models\User::where('id',$data->action_approval)->first();
                      @endphp
                      {{ $userApproval->name ?? '-' }}
                  @endif
                </p>
            </div>  
            <div class="text">
                <p id="two" style="float: left">
                  <b>
                    User Approval Pimpinan : 
                  </b> 
                  @if ($data->action_pimpinan != null)
                      @php
                          $userApprovalPimpinan = App\Models\User::where('id',$data->action_pimpinan)->first();
                      @endphp
                      {{ $userApprovalPimpinan->name ?? '-' }}
                  @endif
                </p>
            </div>  
    </div>
  </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>