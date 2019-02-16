<html>
<head>
    <title>Algoritma Genetika</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/custom.css" type="text/css">
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCjZS3HkjRVfncK_mtUew3TeqnlEYuSnaE "></script>
</head>
<style>
#map {


				width: 100%;
				height: 300px;

				padding: 10px;
			}
</style>
<body>
<nav class="text-white navbar navbar-expand-lg navbar-dark bg-dark ">
    <a class="navbar-brand" href="#">Algoritma Genetika</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>
<div class="container" style="margin-top:50px">

    <div class="row">
        <div class="col-sm">
            <div class="row">
                <div class="col-3">
                    <div class="list-group" id="list-tab" role="tablist">
                      <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Beranda</a>
                      <a class="list-group-item list-group-item-action" id="list-lokasi-list" data-toggle="list" href="#list-lokasi" role="tab" aria-controls="home">Tambah Lokasi</a>
                      <a class="list-group-item list-group-item-action" id="list-tsp-list" data-toggle="list" href="#list-tsp" role="tab" onclick="tampil()" aria-controls="profile">Proses TSP</a>
                    </div>
                </div>
                <div class="col-8">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                            <h3>Selamat Datang!</h3>
                            <div class="alert alert-info"  role="alert">
                                <p>Aplikasi ini merupakan aplikasi menyelesaikan pemasalahan TSP dengan algoritma genetika.</p>
                                <p>Silahkan pilih menu disamping!</p>
                            </div>

                        </div>
                        <div class="tab-pane fade show" id="list-lokasi" role="tabpanel" aria-labelledby="list-encrypt-list">
                            <div id="loadingEnc" class="spinner" style="display:none">
                              <div class="bounce1"></div>
                              <div class="bounce2"></div>
                              <div class="bounce3"></div>
                            </div>
                            <div id="successWrapEnc" class="alert alert-success" style="display:none" role="alert">
                                <strong>Selesai!</strong>
                                <p><span id="successEnc"></span></p>

                            </div>

                            <div id="errorWrapEnc" class="alert alert-danger" style="display:none" role="alert">
                              <strong>Gagal!</strong>
                              <p id="errorEnc"></p>
                            </div>
                            <div id="loadPsnr" style="display:none;"class="sk-folding-cube">
                              <div class="sk-cube1 sk-cube"></div>
                              <div class="sk-cube2 sk-cube"></div>
                              <div class="sk-cube4 sk-cube"></div>
                              <div class="sk-cube3 sk-cube"></div>
                            </div>
                            <form id="lokasiForm" action =""method="post">
                                <div class="form-group">
                                    <label for="inputMsg">Desa</label>
                                    <input type="text" id="inputMsg" name="nama_lokasi" required class="form-control" aria-describedby="inputMsgHelpBlock">
                                    <small id="inputMsgHelpBlock" class="form-text text-muted">
                                      Silahkan masukan pesan yang ingin anda sisipkan pada gambar <span id="batas"></span>
                                    </small>
                                </div>
                                <div class="form-group">
                                    <label for="inputKey">Lokasi</label>

                                    <div id="map"></div>
                                </div>
                                <div class="form-group">

                                        <label for="lat">Latitude</label>
                                        <input type="text" id="lat" name="lat" required class="form-control">
                                </div>
                                <div class="form-group">
                                        <label for="long">Longitude</label>
                                        <input type="text" id="long" name="long" required class="form-control">

                                </div>
                                <button type="submit" style="cursor:pointer" name="enkripsi" data-target=".bd-example-modal-sm" class="btn btn-success  btn-block">Simpan!</button>
                            </form>
                        </div>
                        <div class="tab-pane fade show " id="list-tsp" role="tabpanel" aria-labelledby="list-profile-list">
                            <h4>Cari TSP!</h4>
                            <div id="loadingWrap" class="spinner" style="display:none">
                              <div class="bounce1"></div>
                              <div class="bounce2"></div>
                              <div class="bounce3"></div>
                            </div>
                            <div id="successWrap" class="alert alert-success" style="display:none" role="alert">
                                <strong>Selesai!</strong>
                                <table class="table">
                                    <tr>
                                      <td>Jumlah Iterasi Pembentukan Generasi Baru</td>
                                      <td>:</td>
                                      <td id="jumIterasi"></td>
                                    </tr>
                                    <tr>
                                      <td>Lokasi Awal</td>
                                      <td>:</td>
                                      <td id="lokasi"></td>
                                    </tr>
                                    <tr>
                                      <td>Tahapan</td>
                                      <td>:</td>
                                      <td>
                                          <ol id="tahap">

                                          </ol>
                                      </td>
                                </table>
                            </div>

                            <div id="errorWrap" class="alert alert-danger" style="display:none" role="alert">
                              <strong>Gagal!</strong>
                              <p id="error"></p>
                            </div>

                            <!-- <form id="decryptForm" action="decrypt.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="inputKey">Kata Kunci</label>
                                    <input type="text" id="inputMsg" name="keyDec" class="form-control" aria-describedby="inputKeyHelpBlock">
                                    <small id="inputKeyHelpBlock" class="form-text text-muted">
                                      Silahkan masukan kata kunci
                                    </small>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <label class="input-group-btn" style="margin:0;">
                                            <span class="btn btn-primary btn-file">
                                                Browse&hellip; <input type="file" name="imgDec" style="display: none;" multiple>
                                            </span>

                                        </label>
                                        <input type="text" class="form-control" readonly>
                                    </div>
                                </div>
                                <button type="submit" name="dekripsi" data-toggle="modal" data-target=".bd-example-modal-sm" class="btn btn-success  btn-block">Dekripsi!</button>
                            </form> -->
                            <div class="form-group">
                                <label for="">Lokasi Awal</label>
                                <select style="margin:10px 0 10px 0"id="start"class="form-control form-control-sm">
                            </div>
                            </select>
                            <button style="cursor:pointer"onclick="algen()" class="btn btn-success  btn-block">Algenkan!</button>
                            <br>
                            <div id="resultList" style="display:none">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<table>


</table>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/pooper.min.js" ></script>
    <script src="assets/js/bootstrap.min.js" ></script>
    <script>


        function showEncryptForm(){
            $('#tablePsnr').hide();
            document.getElementById("encryptForm").reset();
            $("#encryptForm").show("fast","linear");
        }

        function tampil(){
          $.ajax({
              url: 'getLokasi.php',
              type: 'get',
              success: function(data){
                  console.log(data)

                  var data = jQuery.parseJSON(data);
                  for(var x in data.message){
                      var html = '<option value="'+x+'">'+data.message[x].nama_lokasi+'</option>';
                      $('#start').append(html);

                  }
                  console.log(data);
                  // console.log(data.daftar_kecamatan);
                  $('select').select();
              },
              error: function(XMLHttpRequest){
                  alert(XMLHttpRequest.responseText);
              }
          });
        }

        function algen(){
            $('#loadingWrap').show();
            $('#successWrap').hide();
            $('#errorWrap').hide();
            $('#resultList').hide();
            var lokasi = $('#start').val();
            $.ajax({
                url: "algen.php?awal="+lokasi,
                type: "POST",
                data:  {lokasi:lokasi},
                contentType: false,
                cache: false,
                processData:false,
                success: function(data){
                     $('#loadingWrap').hide();
                     $('#successWrap').show();
                     $('#resultList').show();
                     var res = $.parseJSON(data);
                     console.log(res);
                     $('#jumIterasi').html(res.iteration);
                     $('#lokasi').html(res.input);
                     $('#tahap').html('');
                     for(var x in res.result){
                        var html = '<li>'+res.result[x]+'</li>';
                        $('#tahap').append(html);
                     }
//
                },
                error: function(XMLHttpRequest){
                  alert(XMLHttpRequest.responseText);
                  console.log(XMLHttpRequest.responseText);
                }
            });
        }

        function updateMarkerPosition(latLng) {
          document.getElementById('lat').value = [latLng.lat()]
            document.getElementById('long').value = [latLng.lng()]
        }


        var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        center: new google.maps.LatLng(-7.781921,110.364678),
         mapTypeId: google.maps.MapTypeId.ROADMAP
          });
        //posisi awal marker
        var latLng = new google.maps.LatLng(-7.781921,110.364678);
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                // x.innerHTML = "Geolocation is not supported by this browser.";
                $('#lat').val('-7.781921');
                $('#long').val('110.364678');
            }
        }

        function showPosition(position) {
            // x.innerHTML = "Latitude: " + position.coords.latitude +
            // "<br>Longitude: " + position.coords.longitude;
            $('#lat').val(position.coords.latitude);
            $('#long').val(position.coords.longitude);
            var latLng = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
            updateMarkerPosition(latLng);
            // marker.setPosition(latLng);
            var marker;
            if (marker != undefined){
                marker.setPosition(newLatLng);
            }else{
              var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: new google.maps.LatLng(position.coords.latitude,position.coords.longitude),
                 mapTypeId: google.maps.MapTypeId.ROADMAP
              });
              var marker = new google.maps.Marker({
                  position : latLng,
                  title : 'lokasi',
                  map : map,
                  draggable : true
                });
            }
            google.maps.event.addListener(marker, 'drag', function() {
             // ketika marker di drag, otomatis nilai latitude dan longitude
             //menyesuaikan dengan posisi marker
                updateMarkerPosition(marker.getPosition());
              });
        }

        $(document).ready( function() {
          getLocation();
            $("#lokasiForm").on('submit',(function(e){
                $('#loadingEnc').show();
                $('#successWrapEnc').hide();
                $('#errorWrapEnc').hide();
                e.preventDefault();
                $.ajax({
                    url: "saveLokasi.php",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data){
                         $('#loadingEnc').hide();
                         var res = $.parseJSON(data);
                         if(res.status == 'error'){
                            var msgs = "Input gagal!";
                            $('#errorEnc').text(msgs);
                            $('#errorWrapEnc').show("fast","linear");
                         }else if(res.status == 'success'){
                             $('#successEnc').text(res.message);
                             $('#successWrapEnc').show("fast","linear");
                         }
//
                    },
                    error: function(XMLHttpRequest){
                      alert(XMLHttpRequest.responseText);
                      console.log(XMLHttpRequest.responseText);
                    }
                });
            }));


        });


    </script>
</body>
</html>
