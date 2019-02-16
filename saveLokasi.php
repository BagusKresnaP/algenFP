<?php
    include "functions.php";
    include "koneksi.php";
    $nama_lokasi = $_POST['nama_lokasi'];
    $lat = $_POST['lat'];
    $long = $_POST['long'];

    $sql = "INSERT INTO lokasi values ('','$nama_lokasi','$lat',$long)";
    $result = $conn->query($sql);
    if($result == false) {
        $data['status'] = 'error';
        $data['message'] = 'Data gagal diinputkan';
    }else{
        $data['status'] = 'success';
        $data['message'] = 'Data sukses diinputkan';
    }

    echo json_encode($data);
?>
