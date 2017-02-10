<?php

require_once __DIR__ . '/config.php';

$ovva = new OVVA();
$ovva = $ovva->getTVProgramme('1plus1');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hackathon-2017</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/material.css" rel="stylesheet" type="text/css">
</head>
<body>

    <div class="title">
        <h1>Телепрограма на <?= date( 'd.m.Y', strtotime($ovva->data->date) ); ?></h1>
    </div>

    <div class="posts">
        <?php foreach ($ovva->data->programs as $program) : ?>
            <div class="post">
                <div class="left_post post_photo">
                    <img src="<?= $program->image->preview; ?>" alt="<?= $program->title; ?>">
                    <?php if (!empty( $program->subtitle )) : ?>
                        <div class="post_subtitle"><?= $program->subtitle; ?></div>
                    <?php endif; ?>
                </div>
                <div class="right_post">
                    <div class="post_title"><?= $program->title; ?></div>
                    <div class="time_tv">
                        <div class="time_start"><?= date('H:i', $program->realtime_begin); ?></div>
                        <div class="time_end"><?= date('H:i', $program->realtime_end); ?></div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</body>
</html>
