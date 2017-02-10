<?php

require_once __DIR__ . '/config.php';

$screen = new ScreenShots();
$screen->saveImageFromWeb( $screen->makeScreenshots() ); // Головна сторінка

$vk = new VK('', 0, '5.62'); // Token User, GroupID, Version API
$photo = $vk->uploadImageOnServer('screen.png');
$res = $vk->photosSaveWallPhoto($photo->server, $photo->photo, $photo->hash);
$vk->wallPost('', 'photo' . $res->response[0]->owner_id . '_' . $res->response[0]->id);
