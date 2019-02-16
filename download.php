<?php  
    if(isset($_GET['get'])){
        $name = $_GET['get'];
        $key = $_GET['key'];
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($name).'"');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: no-cache');
        ob_clean();
        flush();
        readfile('img/stegano/'.$key.$name);
    }
?>