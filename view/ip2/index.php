<?php
namespace Anax\View;

?>
<form method="post" action="<?= url("ip2/validate") ?>">
    <fieldset>
    <legend>Validate ip GEO</legend>
    <p>Enter IP-address to validate</p>
    <p>
        <label>IP-adress:
        <input type="text" name="ip" value="<?= $ip ?>"/>
        </label>
        <input type="submit" name="doSearch" value="Search">
    </p>
    </fieldset>
</form>

<p><a href="<?= url("ip-api2") ?>">IP-validering via REST-API här</a> </p>