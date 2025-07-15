<?php
$project = "paper";
$projectDisplay = ucfirst($project);
ob_start();
?>
<h1><?= $projectDisplay ?> software downloads</h1>
<p class="status">Loading...</p>
<div class="downloads"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $('.status').text("Fetching <?= $projectDisplay ?> releases");

    async function fetchPaperMCReleases() {
        try {
            const projectData = await $.get('https://fill.papermc.io/v3/projects/<?= $project ?>/versions');
            if (projectData.versions) {
                $('.status').text("Found " + projectData.versions.length + " versions");
                for (const version of projectData.versions) {
                    $('.status').text("Fetching release info for " + version.version.id);
                    await handleVersion(version);
                }
                $('.status').text("Done!");
            } else {
                $('.status').text("No <?= $projectDisplay ?> releases found");
            }
        } catch (e) {
            $('.status').text("Failed to fetch <?= $projectDisplay ?> releases");
        }
    }

    async function handleVersion(version) {
        try {
            const buildData = await $.get(`https://fill.papermc.io/v3/projects/<?= $project ?>/versions/${version.version.id}/builds/latest`);

            $('.downloads').append(
                `<p><a href="${buildData.downloads['server:default'].url}"><?= $projectDisplay ?> ${version.version.id} (build ${buildData.id})</a></p>`
            );
        } catch (e) {
            $('.downloads').append(
                `<p>Failed to fetch build info for ${version.version.id}</p>`
            );
        }
    }

    fetchPaperMCReleases();
</script>   
<?php
$content = ob_get_clean();
$topic = "$projectDisplay downloads";
include_once __DIR__ . "/../../../layout.php";
?>