<?php
require('../PHP/constants.php');

function apiConnection($url)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);

    curl_close($ch);

    return $response;
}

function getApiData($parameters=[])
{
    $callableParameters = '';
    foreach($parameters as $parameter){
        $callableParameters = $callableParameters.$parameter;
    }

    $apiurl = constants::API_URL.$callableParameters;

    $response = apiConnection($apiurl);

    $data = file_get_contents($apiurl);
    $data = json_decode($data);

     // Nom de la ville
     $name = $data->name;
    
     // Météo
     $desc = $data->weather[0]->description;
 
     // Températures
     $temp = $data->main->temp;

    $result = new stdClass();
    $result->temp = $temp;   
    $result->description = $desc;
    $result->name = $name;
    var_dump(json_encode($result));
    return json_encode($result);

 
}


function getWeatherCity($city)
{
    $parameters[] = constants::API_CITY.$city;

    $apiConnection = getApiData($parameters);

    return $apiConnection;
}
getWeatherCity('Paris');

?>

