<?php

require_once __DIR__ . '/classes/Web.php';
require_once __DIR__ . '/classes/VK.php';
require_once __DIR__ . '/classes/OVVA.php';

$vk = new VK('', 139842925, '5.60');
$vk->sendRequest([
    'test' => 123,
    'test2' => 144,
    'test4' => 245
]);
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
