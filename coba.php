<canvas id="speedChart" width="600" height="400"></canvas>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCjZS3HkjRVfncK_mtUew3TeqnlEYuSnaE "></script>
<!--script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyC6YamssmmgbT5-EuThTpAHMJIkLqgD38w"></script-->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/Chart.js"></script>
<script>

var arrayLokasi = new Array();
var subArrayLokasi = new Array();
var service = new google.maps.DistanceMatrixService();
var dataSpeed = new Array();
var dataLabel = new Array();
function showGrafik(){
  var speedCanvas = document.getElementById("speedChart");

  Chart.defaults.global.defaultFontFamily = "Roboto";
  Chart.defaults.global.defaultFontSize = 40;

  var speedData = {
    labels: dataLabel,
    datasets: [{
      label: "Fitness",
      data: dataSpeed,
      lineTension: 0,
      fill: false,
      borderColor: 'orange',
      backgroundColor: 'transparent',
      borderDash: [5, 5],
      pointBorderColor: 'orange',
      pointBackgroundColor: 'rgba(255,150,0,0.5)',
      pointRadius: 5,
      pointHoverRadius: 10,
      pointHitRadius: 30,
      pointBorderWidth: 2,
      pointStyle: 'rectRounded'
    }]
  };

  var chartOptions = {
    legend: {
      display: true,
      position: 'top',
      labels: {
        boxWidth: 80,
        fontColor: 'black'
      }
    },
    scales: {
       yAxes: [{
         scaleLabel: {
           display: true,
           labelString: 'Nilai Fitness'
         }
       }],
       xAxes: [{
         scaleLabel: {
           display: true,
           labelString: 'Iterasi'
         },
         ticks: {
           callback: function(value, index, values) {
                               return parseFloat(value).toFixed(2);
            },
           autoSkip: true,
           //maxTicksLimit: 10,
           stepSize: 0.5
           }
       }]
     }
  };

  var lineChart = new Chart(speedCanvas, {
    type: 'line',
    data: speedData,
    options: chartOptions
  });
}

function hitungFitness(){
  $.ajax({
       type: "POST",
       url: "algenTime.php",
       cache: false,

       success: function(data){
           console.log("Ini return php : ");
           var data = jQuery.parseJSON(data);
           console.log(data);
           dataSpeed = data.fitness;
           dataLabel.push(0);
           for(var x=1;x<=200;x++){

               dataLabel.push(x);

           }
           showGrafik();
       }
   });
}

function callback(response, status){
  var origins = response.originAddresses;
  var destinations = response.destinationAddresses;
  for (var i = 0; i < origins.length; i++) {
    var results = response.rows[i].elements;
    for (var j = 0; j < results.length; j++) {
      var element = results[j];
      //console.log(results);
      var duration = element.duration.value;
      subArrayLokasi.push(duration);
    }
    arrayLokasi.push(subArrayLokasi);
    subArrayLokasi = [];
  }
  // console.log(arrayLokasi);
  var jsonString = JSON.stringify(arrayLokasi);
   $.ajax({
        type: "POST",
        url: "getTravelTime.php",
        data: {data : jsonString},
        cache: false,

        success: function(data){
            console.log("Ini return php : ");
            var data = jQuery.parseJSON(data);
            console.log(data);

        }
    });

}

function initLokasi(origin,destination){
  var service = new google.maps.DistanceMatrixService();
  service.getDistanceMatrix(
    {
      origins: origin,
      destinations: destination,
      travelMode: 'DRIVING',
      avoidHighways: false,
      avoidTolls: false,
    }, callback);
}
function tampil(){
  $.ajax({
      url: 'getLokasi.php',
      type: 'get',
      success: function(data){
          console.log(data)
          var origin = new Array();
          var destination = new Array();
          var data = jQuery.parseJSON(data);
          for(var x in data.message){
            if(x<3){
             var originTemp = new google.maps.LatLng(data.message[x].lat, data.message[x].long);
             origin.push(originTemp);
           }

           if(x>-1){
             var originTemp = new google.maps.LatLng(data.message[x].lat, data.message[x].long);
             destination.push(originTemp);
           }


          }
          // destination = origin;
          initLokasi(origin,destination);
          //console.log(arrayLokasi);
      },
      error: function(XMLHttpRequest){
          alert(XMLHttpRequest.responseText);

      }
  });
}

  $(document).ready( function() {
    hitungFitness();
    tampil();
  });
</script>
