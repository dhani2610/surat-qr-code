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

#qrCodeBox {
  height: 550px;
  width: 355px;
  background: #fffffd;
  border-radius: 20px 20px 20px 20px;
  margin-top: 5%;
}

#qrCodeSquareFrame {
  width: 320px;
  height: 320px;
  background: black;
  border-radius: 10px;
  margin: 17px;
  border: solid 1px black;
  position: relative;
}

.centered {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  background: white
}

#qrcode {
  mix-blend-mode: screen;
}

#bubble_01 {
  width: 210px;
  height: 180px;
  /* background: black; */
  position: absolute;
  border-radius: 15px 0 15rem 0;
}

#bubble_02 {
  width: 155px;
  height: 110px;
  /* background: black; */
  position: absolute;
  top: 210px;
  left: 165px;
  border-radius: 100% 0 10px 0;
}

.text {
  width: 90%;
  flex-direction: column;
  text-align: center;
  font-family: Outfit;
  font-size: 18px;
  color: #75767a;
  margin: 10px;
}

#one {
  font-weight: 700;
  font-size: 18px;
  color: #101b39;
}

#two {
  margin-top: -7px;
}

    </Style>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div id="qrCodeBox">
        <div id="qrCodeSquareFrame">
          <div class="centered">
                {!! QrCode::size(290)->generate(env('APP_URL').'/view-detail?kode_surat='.$data->kode_surat) !!}
          </div>
          <div class="text">
            <p id="one">
              SQAN QRCODE Diatas Untuk mendapatkan Link Download File
            </p>
        </div>
        </div>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>