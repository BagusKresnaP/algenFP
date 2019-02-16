<?php
  $dataTime = json_decode(stripslashes($_POST['data']));

  echo json_encode($dataTime);

  ?>
