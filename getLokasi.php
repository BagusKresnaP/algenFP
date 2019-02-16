<?php
    include "functions.php";
    include "koneksi.php";

    $sql = "SELECT * FROM lokasi";
    $result = $conn->query($sql);
    $result_list = array();
    while($row = $result->fetch_array()) {
       $result_list[] = $row;
    }
    if($result == false) {
        $data['status'] = 'error';
        $data['message'] = 'Data gagal diinputkan';
    }else{
        $data['status'] = 'success';
        $data['jum'] = sizeof($result_list);
        $data['message'] = $result_list;
    }

    echo json_encode($data);
?>
