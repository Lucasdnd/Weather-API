<?php
require('../PHP/constants.php');

function apiConnection($url)
{
    //Initialization session cURL
    $ch = curl_init();

    //Session cURL parameters
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

function getApiData($parameters=[],$url)
{
    $callableParameters = '';
    foreach($parameters as $parameter){
        $callableParameters = $callableParameters.$parameter;
    }

    $apiurl = $url.$callableParameters;    

    $response = apiConnection($apiurl);

    $data = file_get_contents($apiurl);
    $data = json_decode($data);
    
    return $data;
}


function getWeatherCity($city)
{
    $parameters[] = constants::API_CITY.$city;

    $data = getApiData($parameters,constants::API_WEATHER_URL);

    //City
    $name = $data->name;

    //Weather
    $desc = $data->weather[0]->description;
  
    //Temp
    $temp = $data->main->temp;
 
    //Coordonates
    $lat = $data->coord->lat;
    $lon = $data->coord->lon;
 
    $data = array(
        array(
            'name'=>$name,
            'lat'=>$lat,
            'lon'=>$lon,
        ),
         
    );

    return $data;
}

function getLastThreeDayForcast($city)
{
    // Get city latitude/longitute
    $cityData = getWeatherCity($city);

    $lat = $cityData[0]['lat'];
    $lon = $cityData[0]['lon'];

    $parameters[] = constants::API_LAT.$lat;
    $parameters[] = constants::API_LON.$lon;
    $parameters[] = constants::API_EXCLUDE.constants::API_EXCLUDE_CURRENT.','.constants::API_EXCLUDE_MINUTELY.','.constants::API_EXCLUDE_HOURLY;  

    $data = getApiData($parameters,constants::API_ONECALL_URL);

    $response = formatForecast(json_encode($data));

    return json_decode($response,true);
}

function formatForecast($data)
{
    $weatherForecasts = json_decode($data,true);

    $i = 0;
    foreach($weatherForecasts['daily'] as $weatherForecast){
        $dataFormat[] = [     
            'dt' => date('d/m/y', $weatherForecast['dt']),
            'temp_day' => $weatherForecast['temp']['day'],
            'desc' => $weatherForecast['weather'][0]['description'],
        ];

        $i++;

        if($i > 2){
            break;
        }
    }

    echo json_encode($dataFormat);
 
    return $data;
}

?>

