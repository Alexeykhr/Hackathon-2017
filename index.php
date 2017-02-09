<?php

require_once __DIR__ . '/classes/Web.php';

$web = new Web();
//$data = $web->getTVProgramme("1plus1");
$web->vk();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>

<div class="container">
    <h1>Телепрограмма на <?= $data->data->date; ?></h1>

    <?php foreach ($data->data->programs as $program) : ?>
        <div class="item">
            <img src="<?= $program->image->preview; ?>" alt="<?= $program->title; ?>" class=""><br>
            <span><?= $program->title . ' ' . $program->subtitle; ?></span><br>
            <span>Початок: <?= date("H:i", $program->realtime_begin); ?></span>
        </div>
    <?php endforeach; ?>

</div>

</body>
</html>
