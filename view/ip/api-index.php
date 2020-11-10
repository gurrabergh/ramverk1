<?php
namespace Anax\View;

?>
<p>To use the API, send a post request to <?= $url ?>, with the ip address as body-parameter "ip".</p>
<form method="post" action="<?= url("ip-api") ?>">
    <fieldset>
    <legend>Validate ip API</legend>
    <p>Enter IP-address to validate</p>
    <p>
        <label>IP-adress:
        <input type="text" name="ip"/>
        </label>
        <input type="submit" name="doSearch" value="Search">
    </p>
    </fieldset>
</form>

<form method="post" action="<?= url("ip-api") ?>">
    <input type="hidden" name="ip" value="2001:4860:4860::8888">
    <input type="submit" name="doSearch" value="Testa IPV6">
</form>
<form method="post" action="<?= url("ip-api") ?>">
    <input type="hidden" name="ip" value="8.8.8.8">
    <input type="submit" name="doSearch" value="Testa IPV4">
</form>

