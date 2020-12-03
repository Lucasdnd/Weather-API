
<?php
require('../PHP/controller.php');

if (isset($_GET['city'])) {
    // header('Content-type:application/json;charset=utf-8');
    return getWeatherCity($_GET['city']);

}
else {
    echo'Error';
}
?>