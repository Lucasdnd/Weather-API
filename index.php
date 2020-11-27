<?php
//clé API
$apikey = "697edce53ba912538458a39d776ca24e";
//Ville
$city = "2172797";
//URL API
$apiurl = "http://api.openweathermap.org/data/2.5/weather?id=" . $city . "&lang=fr&units=metric&APPID=" . $apikey;


$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $apiurl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

curl_close($ch);
$data = json_decode($response);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Weather DO GOOD</title>
</head>
<body>

    <h1>Weather App</h1>
    <h2>Choose Location</h2>
    <span id="error"></span>
    <input type="text" name="city" id="city" placeholder="City Name">
    <button id="submitLocation">Find</button>
    <div id="show"></div>


</body>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
 $(document).ready(function(){

$('#submitLocation').click(function(){

    //get value from input field
    var city = $("#city").val();
    var url = '<?PHP echo $apiurl;?>';

    //check not empty
    if (city != ''){

        $.ajax({

            url: url,
            type: "GET",
            dataType: "jsonp",
            success: function(data){
                console.log(data);
                console.log(data.weather[0].main);
                console.log(data.main);
                console.log(data.main.temp);

                var information = show(data);
                $("#show").html(information);
            }
        });

    }else{
        $('#error').html('Field cannot be empty');
    }

});
})

function show(data){
return  
"<h3>Current Weather: "+ data.main.temp +"</h3>" +
"<h3>Current Weather: "+ data.main.description +"</h3>";
// "<h3>Current Weather: "+ data.weather[0].main +"</h3>" 
}
</script>
</html>