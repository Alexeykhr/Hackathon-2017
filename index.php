<?php

require_once __DIR__ . '/config.php';

$ovva = new OVVA();
$ovva = $ovva->getTVProgramme('1plus1');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>

<div class="container">
    <h1>Телепрограмма на <?= date('d.m.Y', strtotime($ovva->data->date)); ?></h1>

    <div class="items">
        <?php foreach ($ovva->data->programs as $program) : ?>
        <div class="item">
            <img src="<?= $program->image->preview; ?>" alt="<?= $program->title; ?>">
            <?= $program->title . ' ' . $program->subtitle; ?>
            Початок: <?= date("H:i", $program->realtime_begin); ?>
        </div>
        <?php endforeach; ?>
    </div>

</div>

</body>
</html>
