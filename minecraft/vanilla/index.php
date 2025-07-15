<?php
ob_start();
?>
<h1>Vanilla software downloads</h1>
<p class="status">Loading...</p>
<div class="downloads"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $('.status').text("Fetching Vanilla releases");

    async function fetchPurpurMCReleases() {
        try {
            const projectData = await $.get('https://launchermeta.mojang.com/mc/game/version_manifest.json');
            if (projectData.versions) {
                $('.status').text("Found " + projectData.versions.length + " versions");
                for (const version of projectData.versions) {
                    $('.status').text("Fetching release info for " + version.id);
                    await handleVersion(version);
                }
                $('.status').text("Done!");
            } else {
                $('.status').text("No Vanilla releases found");
            }
        } catch (e) {
            $('.status').text("Failed to fetch Vanilla releases");
        }
    }

    async function handleVersion(version) {
        try {
            const buildData = await $.get(version.url);
            if (buildData.downloads && buildData.downloads.server) {
                const downloadUrl = buildData.downloads.server.url;

                $('.downloads').append(
                    `<p><a href="${downloadUrl}">Vanilla ${version.id}</a></p>`
                );
            }
        } catch (e) {
            $('.downloads').append(
                `<p>Failed to fetch build info for ${version}</p>`
            );
        }
    }

    fetchPurpurMCReleases();
</script>   
<?php
$content = ob_get_clean();
$topic = "$project downloads";
include_once __DIR__ . "/../../layout.php";
?>