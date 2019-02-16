<?php
    include "functions.php";
    include "koneksi.php";
    $pc = 0.25;
    $mc = 0.25;
    $thresold = 0.1;

    $input = 1;
    //Import data from mysql
    $sql = "SELECT * FROM lokasi";
    $result = $conn->query($sql);

    $result_list = array();
    while($row = $result->fetch_array()) {
       $result_list[] = $row;
    }

    //Get distance of 2 point
    $jarakPoint = array();
    foreach($result_list as $x => $firstRow) {
        foreach($result_list as $y => $secondRow) {
            $jarakPoint[$x][$y] = haversineGreatCircleDistance($firstRow['lat'],$firstRow['long'],$secondRow['lat'],$secondRow['long']);
        }
    }

    //intialize population
    $randomValue = array();
    $counter = 0;
    for($x=0;$x<$result->num_rows;$x++){
      if($x != $input){
        $randomValue[$counter] = $x;
        $counter++;
      }
    }

    $population = array();
    for($x=0;$x<4;$x++){
        shuffle($randomValue);
        array_push($population,$randomValue);
    }


    //setFitness
    $fitness = array();
    $totalFitness=0;
    for($x=0;$x<4;$x++){
      $fitness[$x] = $jarakPoint[$input][$population[$x][0]];
      for($y=0;$y<$result->num_rows-2;$y++){
          $fitness[$x]+= $jarakPoint[$population[$x][$y]][$population[$x][$y+1]];
      }

      $totalFitness+=$fitness[$x];
    }

    $selisih = 1;

    //selection parent
    $counter = 0;
    asort($fitness);
    foreach($fitness as $key => $value){
      $parent[$counter] = $key;
      $counter++;
      if($counter == 2){
        break;
      }
    }

    $oldMeanAverage = $totalFitness/4;
    $iterasi = 0;
    while($selisih>$thresold){
        $iterasi++;
        //crossover order
        $randomNumber1 = rand(0,$result->num_rows-2);
        do{
          $randomNumber2 = rand(0,$result->num_rows-2);
        }while($randomNumber1 == $randomNumber2);

        if($randomNumber1 > $randomNumber2){
            $temp = $randomNumber1;
            $randomNumber1 = $randomNumber2;
            $randomNumber2 = $temp;
        }

        for($x=0;$x<=$result->num_rows-2;$x++){
          if($x>=$randomNumber1 && $x<=$randomNumber2){
              $child[$x] = $population[$parent[0]][$x];
          }else{
              $child[$x] = -1;
          }
        }

        $arraySisa = array_diff($population[$parent[1]], $child);

        $counter = 0;
        foreach($arraySisa as $list){
            while($child[$counter] != -1){
                $counter++;
            }
            $child[$counter] = $list;
        }
        array_push($population,$child);

        //mutation inversion
        $randomNumber1 = rand(0,$result->num_rows-2);
        do{
          $randomNumber2 = rand(0,$result->num_rows-2);
        }while($randomNumber1 == $randomNumber2);


        if($randomNumber1 > $randomNumber2){
            $temp = $randomNumber1;
            $randomNumber1 = $randomNumber2;
            $randomNumber2 = $temp;
        }

        $counter = 0;
        for($x=$randomNumber1;$x<=$randomNumber2;$x++){
            $arrayTemp[$counter] = $population[$parent[0]][$x];
            $counter++;
        }

        $counter--;
        for($x=0;$x<=$result->num_rows-2;$x++){
            if($x>=$randomNumber1 && $x<=$randomNumber2){
                $child[$x] = $arrayTemp[$counter];
                $counter--;
            }else{
                $child[$x] = $population[$parent[0]][$x];
            }
        }


        array_push($population,$child);



        //selection
        $fitness = array();
        for($x=0;$x<6;$x++){
          $fitness[$x] = $jarakPoint[$input][$population[$x][0]];
          for($y=0;$y<$result->num_rows-2;$y++){
              $fitness[$x]+= $jarakPoint[$population[$x][$y]][$population[$x][$y+1]];
          }
        }

        // print_r($fitness);echo"<br>";
        asort($fitness);
        $counter = 0;
        foreach($fitness as $key => $value){
          $popSelection[$counter] = $key;
          $counter++;
        }
        $counter = 0;
        $populationTemp = array();
        $totalFitness = 0;
        $fitnessAwal = array();
        foreach($popSelection as $list){
          if($counter != 4){
            array_push($populationTemp,$population[$list]);
            // array_push($populationTemp[$counter],$fitness[$list]);

            $totalFitness += $fitness[$list];
            $fitnessAwal[$counter] = $fitness[$list];
          }else{
            break;
          }

          $counter++;
        }

        $newMeanAverage = $totalFitness/4;
        $selisih = abs($newMeanAverage-$oldMeanAverage);
        $oldMeanAverage = $newMeanAverage;
        $population = $populationTemp;
        $fitness = $fitnessAwal;

        //Show me if you want to print result
        // echo "<br>";
        // echo "setelah selection :";
        // echo "<br>";
        // foreach($population as $key => $list){
        //     print_r($list);
        //     echo "===>".$fitness[$key]."<br>";
        // }

        $parent[0] = 0;
        $parent[1] = 1;
    }

    //Return result
    $result = array();
    foreach($population[0] as $list){
        array_push($result,$result_list[$list]['nama_lokasi']);
    }

    $data['result'] = $result;
    $data['input'] = $result_list[$input]['nama_lokasi'];
    $data['iteration'] = $iterasi;

    echo json_encode($data);
?>
