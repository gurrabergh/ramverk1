<?php
namespace Anax\View;

?>

<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=<?= $long1 ?>%2C<?= $lat1 ?>%2C<?= $long2 ?>%2C<?= $lat2 ?>&amp;layer=mapnik&amp;marker=<?= $lat ?>%2C<?= $long ?>" style="border: 1px solid black"></iframe><br/><small><a href="https://www.openstreetmap.org/#map=8/<?= $long ?>/<?= $lat ?>">Visa större karta</a></small>

<p>Just nu är det <?= $today["current"]["weather"][0]["description"] ?> och temperaturen är <?= $weather[0]["current"]["temp"] ?> &#176;C</p>
<h4>Väder från och med idag </h4>

<table class="weather">
    <thead>
        <tr>
            <th>Dag</th>
            <th>Väder</th>
            <th colspan="3">Dagstemperatur</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($today["daily"] as $day) { ?>
            <tr>
                <th><?= \date("D", $day["dt"]) ?></th>
                <td><?= $day["weather"][0]["description"]?></td>
                <td><?= $day["temp"]["day"] ?>&#176;C</td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<h4>Senaste 5 dagarna</h4>

<table class="weather">
    <thead>
        <tr>
            <th>Datum</th>
            <th>Väder</th>
            <th colspan="3">Temperatur</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($weather as $day) { ?>
            <tr>
                <th><?= \date("Y-m-d", $day["current"]["dt"]) ?></th>
                <td><?= $day["current"]["weather"][0]["description"] ?></td>
                <td><?= $day["current"]["temp"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>