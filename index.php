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
                <div class="left-post post-photo">
                    <img src="<?= $program->image->preview; ?>" alt="<?= $program->title; ?>">
                </div>
                <div class="right-post">
                    <div class="post-title"><?= $program->title; ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>


</body>
</html>
