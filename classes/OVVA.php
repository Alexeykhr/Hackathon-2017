<?php

class OVVA extends Web
{
    const OVVA_METHOD = 'https://api.ovva.tv/v2/ua/tvguide/';

    /**
     * Get schedule from OVVA api
     *
     * @param string $canal
     * @return mixed
     */
    public function getTVProgramme($canal)
    {
        return $this->curl(self::OVVA_METHOD . $canal);
    }
}