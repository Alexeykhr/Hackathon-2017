<?php

class OVVA extends Web
{
    /** @var string OVVA_URL url OVVA api. */
    const OVVA_URL = 'https://api.ovva.tv/v2/ua/tvguide/';

    /**
     * Get request from OVVA api.
     *
     * @param string $channel
     * @return object
     */
    public function getTVProgramme($channel)
    {
        return $this->curl( self::OVVA_URL . $channel );
    }
}