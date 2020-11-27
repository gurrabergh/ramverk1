<?php
namespace Anax\View;

?>
<form method="post" action="<?= url("weather/search-ip") ?>">
    <fieldset>
    <legend>Get weather forecast</legend>
    <p>Enter Coordinates or IP-address to get a forecast</p>
    <p>
        <label>IP-adress:
        <input type="text" name="ip" value=""/>
        </label>
        <input type="submit" name="doSearch" value="Search">
    </p>
</form>

<form method="post" action="<?= url("weather/search-cord") ?>">
    <p>
        <label>Lat:
        <input type="text" name="lat" value=""/>
        </label>
        <label>Long:
        <input type="text" name="long" value=""/>
        </label>
        <input type="submit" name="doSearch" value="Search">
    </p>
    </fieldset>
</form>

<p><a href="<?= url("weather-api") ?>">Väder via REST-API här</a> </p>