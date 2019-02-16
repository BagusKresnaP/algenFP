<?php
  // $dataTime = json_decode(stripslashes($_POST['data']));

  $dataTime = array(
    array(0, 5810, 9086, 10670, 9554, 11495, 15360, 12841, 12434, 11536, 10506, 9661, 10330, 11879, 11952, 11996, 7664, 5776, 13677, 13273, 12683),
    array(5635, 0, 9574, 8230, 10172, 9766, 14300, 13231, 10708, 16160, 15130, 9770, 11884, 10811, 10223, 10266, 6368, 1933, 13338, 11547, 10824),
    array(9055, 9052, 0, 3332, 1768, 3267, 7670, 6195, 4209, 10008, 6121, 1526, 3172, 3583, 3724, 3767, 4708, 8984, 6211, 5048, 4325),
    array(10285, 7599, 3315, 0, 3811, 3001, 7535, 6466, 3976, 11907, 9243, 3745, 5518, 4046, 3458, 3501, 3255, 7531, 6573, 4816, 3782),
    array(9531, 9684, 1768, 3831, 0, 2679, 7150, 5543, 3618, 8828, 4940, 2936, 1992, 2931, 3136, 3179, 5340, 9616, 5559, 4457, 4137),
    array(11771, 9085, 3250, 2963, 2680, 0, 4607, 3498, 1061, 9152, 6488, 4705, 4379, 1290, 576, 620, 4741, 9017, 3514, 1900, 2134),
    array(15405, 13776, 7940, 7654, 7371, 4808, 0, 5034, 4372, 7410, 7916, 9396, 9069, 5262, 4227, 4678, 9432, 13708, 4361, 5016, 5249),
    array(12609, 12608, 6252, 6486, 5614, 3560, 4842, 0, 3561, 6575, 3911, 7707, 5160, 2960, 3416, 3867, 8264, 12540, 1319, 4205, 4438),
    array(12737, 10051, 4215, 3929, 3645, 1111, 4133, 3494, 0, 9033, 7231, 5670, 5344, 2374, 1018, 707, 5707, 9984, 3171, 961, 1195),
    array(11779, 16271, 10179, 11957, 8995, 9240, 7657, 6742, 9289, 0, 3686, 11212, 7963, 8140, 9145, 9596, 13988, 16203, 6183, 9933, 10167),
    array(10674, 15166, 6155, 9368, 4971, 6650, 8125, 4152, 7231, 3678, 0, 7188, 3939, 5550, 6861, 7211, 11145, 15098, 4988, 7875, 8108),
    array(9609, 9168, 1507, 3718, 2979, 4680, 9084, 7608, 5622, 11098, 7210, 0, 4261, 4996, 5137, 5181, 4824, 9101, 7624, 6461, 5738),
    array(10313, 11330, 3178, 5474, 1993, 4350, 8821, 5313, 5289, 7807, 3920, 4210, 0, 4602, 4807, 4850, 6986, 11262, 6149, 6128, 5809),
    array(11900, 10123, 3558, 4001, 2920, 1284, 4982, 2883, 2306, 8120, 5457, 5014, 4619, 0, 1592, 1865, 5779, 10055, 3340, 3146, 3379),
    array(12234, 9549, 3713, 3427, 3143, 581, 4077, 3438, 951, 8977, 6701, 5168, 4842, 1590, 0, 451, 5205, 9481, 3115, 1725, 1958),
    array(12278, 9592, 3757, 3470, 3187, 625, 4432, 3794, 639, 9333, 7055, 5212, 4886, 1888, 456, 0, 5248, 9525, 3471, 1479, 1712),
    array(7257, 7627, 5483, 4139, 6081, 5674, 10208, 9139, 6616, 12384, 11353, 5679, 7792, 6720, 6131, 6175, 0, 7559, 9247, 7456, 6733),
    array(5583, 1921, 9493, 8149, 10091, 9685, 14219, 13150, 10627, 16079, 15049, 9689, 11802, 10730, 10142, 10185, 6286, 0, 13257, 11466, 10743),
    array(13648, 12614, 6241, 6492, 5603, 3647, 4259, 1213, 3210, 6167, 4950, 7697, 6198, 3401, 3066, 3517, 8270, 12546, 0, 3854, 4087),
    array(13643, 10957, 5121, 4699, 4551, 2017, 4997, 4359, 1042, 9898, 8095, 6576, 6250, 3280, 1906, 1612, 6613, 10889, 4036, 0, 1270),
    array(12645, 9959, 4327, 3552, 3958, 2167, 5183, 4545, 1228, 10084, 8281, 5782, 5657, 3430, 2073, 1762, 5615, 9891, 4222, 1271, 0)
  );
  include "functions.php";
  include "koneksi.php";

  $sql = "SELECT * FROM lokasi";
  $result = $conn->query($sql);

  // Input
  $input = 20;
  $lamaWaktu = 64800;
  $jumKromosom = 16;
  $cr = 0.5;
  $jumOffspringCrossover = ceil($jumKromosom*$cr);
  $mr = 0.5;
  $jumOffspringMutation = ceil($jumKromosom*$mr);

  $result_list = array();
  while($row = $result->fetch_array()) {
     $result_list[] = $row;
  }

  // foreach($dataTime as $x=>$list){
  //   foreach($list as $y=>$time){
  //     $data[$x][$y] = $time;
  //   }
  // }

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
  for($x=0;$x<$jumKromosom;$x++){
      shuffle($randomValue);
      array_push($population,$randomValue);
  }

  $totalFitness = array();
  //Seleksi lokasi
  $awalTime = 21600; //Start pencarian lokasi pukul 6 pagi
  $batasTime = 64800; //Batas kunjungan pukul 6 sore
  $perHari = 86400; //detik perhari
  $lamaWisata = 7200; //kunjungan wisata 2jam
  $indexBatas = array();
  $waktu = array();
  $temp = array();
  $temp1 = array();
  $lamaKunjunganWisata = array();
  for($x=0;$x<$jumKromosom;$x++){
      $hari = 1;
      $lamaPerjalanan = $awalTime;
      $lamaKunjunganWisata[$x] = 0;
      for($y=-1;$y<$result->num_rows-2;$y++){
        if($y == -1){
          $lamaPerjalanan+= $dataTime[$input][$population[$x][0]];
        }else{
          $lamaPerjalanan+= $dataTime[$population[$x][$y]][$population[$x][$y+1]];
        }

        if($lamaPerjalanan >= ($hari*$batasTime)){
          $temp1[$x] = $lamaPerjalanan;
          $lamaPerjalanan = (ceil($lamaPerjalanan/$perHari)*$perHari) + $awalTime;
          $hari++;
        }else{
          $lamaPerjalanan+= $lamaWisata;
          $lamaKunjunganWisata[$x]+=$lamaWisata ;
          if($lamaPerjalanan >= ($hari*$batasTime)){
            $temp[$x] = $lamaPerjalanan;
            $lamaPerjalanan = (ceil($lamaPerjalanan/$perHari)*$perHari) + $awalTime;
            $hari++;
          }
        }

        if($lamaPerjalanan >= $lamaWaktu){
          $indexBatas[$x] = $y;
          break;
        }
      }
      $waktu[$x] = $lamaPerjalanan;
  }

  //hitung fitness
  $fitness = array();
  for($x=0;$x<$jumKromosom;$x++){
      $lamaPerjalanan = 0;
      $rating = 0;
      $count = 0;
      for($y=-1;$y<=$indexBatas[$x];$y++){
          if($y==-1){
            $lamaPerjalanan+= $dataTime[$input][$population[$x][0]]/ $result_list[$y+1]['rating'];
          }else{
            $lamaPerjalanan+= $dataTime[$population[$x][$y]][$population[$x][$y+1]]/  $result_list[$y+1]['rating'];

          }
          // $rating+=$result_list[$y+1]['rating'];
          $count++;
      }

      // $rataRating = $rating/$count;
      $fitness[$x] = (($indexBatas[$x]+1) * $lamaKunjunganWisata[$x])/$lamaPerjalanan;
  }
  $data['kromosomAwal'] = $population;

  $countAkhir = 0;
  $fitnessAkhir = array();
  while($countAkhir < 200){
    //crossover
    $randomNumberCross = array();
    $randomParentCross = array();
    for($i=0;$i<$jumOffspringCrossover;$i++){
       $parent1 = rand(0,$jumKromosom-1);
       do{
          $parent2 = rand(0,$jumKromosom-1);
       }while($parent1 == $parent2);

       $randomNumber1 = rand(0,$result->num_rows-2);
       do{
         $randomNumber2 = rand(0,$result->num_rows-2);
       }while($randomNumber1 == $randomNumber2);

       array_push($randomParentCross,array($parent1,$parent2));
       array_push($randomNumberCross,array($randomNumber1,$randomNumber2));

       if($randomNumber1 > $randomNumber2){
           $temp = $randomNumber1;
           $randomNumber1 = $randomNumber2;
           $randomNumber2 = $temp;
       }

       for($x=0;$x<=$result->num_rows-2;$x++){
         if($x>=$randomNumber1 && $x<=$randomNumber2){
             $child[$x] = $population[$parent1][$x];
         }else{
             $child[$x] = -1;
         }
       }

       $arraySisa = array_diff($population[$parent2], $child);
       //print_r($arraySisa);
       $counter = 0;
       foreach($arraySisa as $list){
           while($child[$counter] != -1){
               $counter++;
           }
           $child[$counter] = $list;
       }
       array_push($population,$child);

    }

    $data['kromosomCross'] = $population;

    //mutation
    $parentMutation = array();
    $randomNumberMutation = array();
    for($i=0;$i<$jumOffspringMutation;$i++){
        do{
          $parent = rand(0,$jumKromosom-1);
        }while(in_array($parent, $parentMutation));
        array_push($parentMutation,$parent);

        $randomNumber1 = rand(0,$result->num_rows-2);
        do{
          $randomNumber2 = rand(0,$result->num_rows-2);
        }while($randomNumber1 == $randomNumber2);

        array_push($randomNumberMutation,array($randomNumber1,$randomNumber2));


        if($randomNumber1 > $randomNumber2){
            $temp = $randomNumber1;
            $randomNumber1 = $randomNumber2;
            $randomNumber2 = $temp;
        }

        $counter = 0;
        for($x=$randomNumber1;$x<=$randomNumber2;$x++){
            $arrayTemp[$counter] = $population[$parent][$x];
            $counter++;
        }

        $counter--;
        for($x=0;$x<=$result->num_rows-2;$x++){
            if($x>=$randomNumber1 && $x<=$randomNumber2){
                $child[$x] = $arrayTemp[$counter];
                $counter--;
            }else{
                $child[$x] = $population[$parent][$x];
            }
        }


        array_push($population,$child);
    }

    //hitung fitness untuk Seleksi

    // $indexBatas = array();
    $waktu = array();
    $temp = array();
    $temp1 = array();
    // $lamaKunjunganWisata = array();
    $totalPopulation = $jumKromosom+$jumOffspringMutation+$jumOffspringCrossover;
    for($x=$jumKromosom;$x<$totalPopulation;$x++){
        $hari = 1;
        $lamaPerjalanan = $awalTime;
        $lamaKunjunganWisata[$x] = 0;
        for($y=-1;$y<$result->num_rows-2;$y++){
          if($y == -1){
            $lamaPerjalanan+= $dataTime[$input][$population[$x][0]];
          }else{
            $lamaPerjalanan+= $dataTime[$population[$x][$y]][$population[$x][$y+1]];

          }

          if($lamaPerjalanan >= ($hari*$batasTime)){
            $temp1[$x] = $lamaPerjalanan;
            $lamaPerjalanan = (ceil($lamaPerjalanan/$perHari)*$perHari) + $awalTime;
            $hari++;
          }else{
            $lamaPerjalanan+= $lamaWisata;
            $lamaKunjunganWisata[$x]+=$lamaWisata;
            if($lamaPerjalanan >= ($hari*$batasTime)){
              $temp[$x] = $lamaPerjalanan;
              $lamaPerjalanan = (ceil($lamaPerjalanan/$perHari)*$perHari) + $awalTime;
              $hari++;
            }
          }

          if($lamaPerjalanan >= $lamaWaktu){
            $indexBatas[$x] = $y;
            break;
          }
        }
        $waktu[$x] = $lamaPerjalanan;
    }

    for($x=$jumKromosom;$x<$totalPopulation;$x++){
        $lamaPerjalanan = 0;
        $rating = 0;
        $count = 0;
        for($y=-1;$y<=$indexBatas[$x];$y++){
            if($y==-1){
              $lamaPerjalanan+= $dataTime[$input][$population[$x][0]];
            }else{
              $lamaPerjalanan+= $dataTime[$population[$x][$y]][$population[$x][$y+1]];

            }
            $rating+=$result_list[$y+1]['rating'];
            $count++;
        }

        $rataRating = $rating/$count;
        $fitnessChild = (($indexBatas[$x]+1) * $lamaKunjunganWisata[$x] * $rataRating)/$lamaPerjalanan;
        array_push($fitness,$fitnessChild);
    }

    arsort($fitness);
    $counter = 0;
    foreach($fitness as $key => $value){
      $popSelection[$counter] = $key;
      $counter++;
    }
    $counter = 0;
    $populationTemp = array();
    $totalFitness = 0;
    $fitnessAwal = array();
    $indexBatasTemp = array();
    foreach($popSelection as $list){
      if($counter != $jumKromosom){
        array_push($populationTemp,$population[$list]);
        // array_push($populationTemp[$counter],$fitness[$list]);

        $totalFitness += $fitness[$list];
        $fitnessAwal[$counter] = $fitness[$list];
        $indexBatasTemp[$counter] = $indexBatas[$list];
      }else{
        break;
      }

      $counter++;
    }

    $population = $populationTemp;
    $fitness = $fitnessAwal;
    $indexBatas = $indexBatasTemp;
    $countAkhir++;
    $nilaiFitness = $fitness[0];
    array_push($fitnessAkhir,$fitness[0]);
    // print_r($fitness);
    // echo "<br>";
    // echo "-----------------------------------------------";
    // echo "<br>Jum kunjungan lokasi : <br>";
    // print_r($indexBatas);
    // echo "<br>-----------------------------------------------";
    // echo "<br>";
    // array_push($totalFitness, $nilaiFitness);
  }
  $destinasi = array();
  foreach($population[0] as $key=>$pop){
      if(($indexBatas[0]+1) >= $key ){
        array_push($destinasi,$result_list[$pop]);
      }
  }





  // $data['kromosom'] = $population;
  // $data['travelTime'] = $dataTime;
  // $data['pointCross'] = $randomNumberCross;
  // $data['parentCross'] = $randomParentCross;
  // $data['parentMutation'] = $parentMutation;
  // $data['pointMutation'] = $randomNumberMutation;
  $data['destinasi'] = $destinasi;
  $data['batas'] = $indexBatas[0];
  $data['fitness'] = $fitnessAkhir;

  $data['fitness_akhir'] = $fitnessAkhir[199];
  // $data['fitness_akhir'] = $fitnessAkhir;
  // $data['population_akhir'] = $populationTemp;
  // $data['batas'] = $indexBatas;
  // $data['waktu'] = $waktu;
  // $data['timeTravel'] = $dataTime;
  //
  // $data['temp1'] = $temp1;
  //
  // $data['temp'] = $temp;














  echo json_encode($data);

?>
