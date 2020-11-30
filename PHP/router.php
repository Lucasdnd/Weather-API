<?php
require('../PHP/controller.php');

if (isset($_GET['city'])) {
   return getWeatherCity($_GET['city']);

}
else {
    echo'Error';
}
?>