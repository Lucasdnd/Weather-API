<?php

class constants {
  // API URL PARAMETERS
  const API_CITY = "&q=";
  const API_LAT = "&lat=";
  const API_LON = "&lon=";
  const API_EXCLUDE = "&exclude=";

  const API_KEY = "697edce53ba912538458a39d776ca24e";
  const API_LANG = "fr";
  const API_UNITS = "metric";

  //API EXCLUDE PARAMETERS
  const API_EXCLUDE_CURRENT = "current";
  const API_EXCLUDE_MINUTELY = "minutely";
  const API_EXCLUDE_HOURLY = "hourly";
  const API_EXCLUDE_DAILY = "daily";
  const API_EXCLUDE_ALERTS = "alerts";

  //API URLs
  const API_WEATHER_URL = "http://api.openweathermap.org/data/2.5/weather?lang=".self::API_LANG."&units=".self::API_UNITS."&APPID=".self::API_KEY;
  const API_ONECALL_URL = "http://api.openweathermap.org/data/2.5/onecall?lang=".self::API_LANG."&units=".self::API_UNITS."&APPID=".self::API_KEY;
}