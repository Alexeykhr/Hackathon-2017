<?php

class ScreenShots extends Web
{
    /** @var string SHOT url api to make screenshots. */
    const SHOT = 'http://mini.s-shot.ru/1024x0/1024/jpeg/?';

    /**
     * Make screenshots.
     *
     * @param mixed $url
     * @return string
     */
    public function makeScreenshots($url = MAIN_PAGE)
    {
        $this->curl( self::SHOT . $url );
        return self::SHOT . $url;
    }

    /**
     * Save image from web
     *
     * @param string $url
     * @param string $dir
     * @return void
     */
    public function saveImageFromWeb($url, $dir = __DIR__ . '/../img/screen.png')
    {
        copy($url, $dir);
    }
}