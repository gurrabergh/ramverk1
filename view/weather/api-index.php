<?php
namespace Anax\View;

?>
<p>To use the API, send a post request to <?= $url ?>, with the ip address as body-parameter "ip", or long/lat as body parameters "long" and "lat".</p>

<form method="post" action="<?= url("weather-api/search-ip") ?>">
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

<form method="post" action="<?= url("weather-api/search-cord") ?>">
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

