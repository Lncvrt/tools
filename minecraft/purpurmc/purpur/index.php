<?php
$project = "purpur";
$projectDisplay = ucfirst($project);
ob_start();
?>
<h1><?= $projectDisplay ?> software downloads</h1>
<p class="status">Loading...</p>
<div class="downloads"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $('.status').text("Fetching <?= $projectDisplay ?> releases");

    async function fetchPurpurMCReleases() {
        try {
            const projectData = await $.get('https://api.purpurmc.org/v2/<?= $project ?>');
            if (projectData.versions) {
                $('.status').text("Found " + projectData.versions.length + " versions");
                for (const version of projectData.versions.reverse()) {
                    $('.status').text("Fetching release info for " + version);
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
            const buildData = await $.get(`https://api.purpurmc.org/v2/<?= $project ?>/${version}`);
            if (buildData.builds && buildData.builds.all.length > 0) {
                const latestBuild = buildData.builds.latest
                const downloadUrl = `https://api.purpurmc.org/v2/<?= $project ?>/${version}/${latestBuild}/download`;

                $('.downloads').append(
                    `<p><a href="${downloadUrl}"><?= $projectDisplay ?> ${version} (build ${latestBuild})</a></p>`
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
$topic = "$projectDisplay downloads";
include_once __DIR__ . "/../../../layout.php";
?>