<?php
ob_start();
?>
<h1>Minecraft tools</h1>
<p>Right now this is only for server software downloads, to pick what version you want and what server software you want</p>
<p>What server software would you like to download?</p>
<p><a href="/minecraft/papermc">PaperMC</a> &bull; <a href="/minecraft/purpurmc">PurpurMC</a> &bull; <a href="/minecraft/vanilla/">Vanilla</a></p>
<?php
$content = ob_get_clean();
$topic = "Minecraft";
include_once __DIR__ . "/../layout.php";
?>