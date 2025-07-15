<?php
ob_start();
?>
<h1>PaperMC software downloads</h1>
<p>Select what project by PaperMC you want to get downloads for</p>
<p><a href="/minecraft/papermc/paper/">Paper</a> &bull; <a href="/minecraft/papermc/travertine/">Travertine</a> &bull; <a href="/minecraft/papermc/waterfall/">Waterfall</a> &bull; <a href="/minecraft/papermc/velocity/">Velocity</a> &bull; <a href="/minecraft/papermc/folia/">Folia</a></p>
<?php
$content = ob_get_clean();
$topic = "PaperMC downloads";
include_once __DIR__ . "/../../layout.php";
?>