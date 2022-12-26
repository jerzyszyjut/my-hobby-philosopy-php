<!DOCTYPE html>
<html lang="pl">

<?php
require_once '../layouts/components/head.php';
?>

<body>

<?php
require_once '../layouts/components/navbar.php';
?>

<div class="wrapper">
    <?php
    require_once '../NotificationsHandler.php';
    if ($errors) {
        foreach ($errors as $error) {
            echo "<p class='error'>{$error}</p>";
        }
    }
    if ($infos) {
        foreach ($infos as $info) {
            echo "<p class='info'>{$info}</p>";
        }
    }
    require_once "../layouts/{$content}";
    ?>
</div>

<?php
require_once '../layouts/components/footer.php';
?>

</body>
</html>
