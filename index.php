<?php
ob_start();
?>
<p>A simple website with a few tools you can use</p>
<p>Click below to select a tool:</p>
<p><a href="https://geometrytools.lncvrt.xyz/">Geometry Dash tools</a><br/>
<a href="/minecraft/">Minecraft tools</a></p>
<?php
$content = ob_get_clean();
$topic = "Home";
include_once __DIR__ . "/layout.php";
?>