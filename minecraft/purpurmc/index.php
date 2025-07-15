<?php
ob_start();
?>
<h1>PurpurMC software downloads</h1>
<p>Select what project by PurpurMC you want to get downloads for</p>
<p><a href="/minecraft/purpurmc/purpur/">Purpur</a> &bull; <a href="/minecraft/purpurmc/purformance/">Purformance</a></p>
<?php
$content = ob_get_clean();
$topic = "PurpurMC downloads";
include_once __DIR__ . "/../../layout.php";
?>