<?php

class Web
{
    /**
     * Token from VK
     *
     * @var string $_token
     */
    private $_token = '';

    /**
     * ID group from VK
     *
     * @var int $_groupID
     */
    private $_groupID = 139842925;

    /**
     * Version API VK
     *
     * @var int $_version
     */
    private $_version = 5.62;

    const VK_METHOD = 'https://api.vk.com/method/';
    const OVVA_METHOD = 'https://api.ovva.tv/v2/ru/tvguide/';

    /**
     * GET/POST json from/to page
     *
     * @param string $url
     * @param string $method
     * @param array $fields
     * @return object
     */
    public function curl($url, $method = 'GET', $fields = [])
    {
        $ch = curl_init( $url );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        if ( mb_strtoupper( $method ) == 'POST' ) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        }

        $result = json_decode( curl_exec($ch) );
        curl_close($ch);

        return $result;
    }

    /**
     * GET/POST from/to VK
     *
     * @param array $arr
     * @return object
     */
    public function vk($arr = [])
    {
        $keys = array_keys($arr);
        var_dump($keys); die;
    }

    /**
     * Upload image on VK server
     *
     * @return object
     */
    public function uploadImage()
    {
        $cFile = curl_file_create( realpath( 'img/schedule.png' ) );
        $fields = [ 'photo' => $cFile ];

        return $this->curl(
            $this->getUploadServer()->response->upload_url,
            'POST',
            $fields
        );
    }

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

    /*
     * Get upload link from vk api
     */
    public function getUploadServer()
    {
        return $this->curl(self::VK_METHOD . 'photos.getWallUploadServer?group_id='.$this->_groupID.'&v=5.62&access_token=' . $this->_token);
    }

    /*
     * Save image on VK server
     */
    public function photoSave()
    {
        $photoInfo = $this->uploadImage();
        return $this->curl(self::VK_METHOD . 'photos.saveWallPhoto?group_id=' . $this->_groupID . '&server=' . $photoInfo->server . '&photo=' . stripslashes($photoInfo->photo) . '&hash=' . $photoInfo->hash . '&v=' . $this->_version . '&access_token=' . $this->_token);
    }

    /*
     * Post image on group wall
     */
    public function postOnWall()
    {
        $photoInfo = $this->photoSave();
        return $this->curl(self::VK_METHOD . 'wall.post?owner_id=-' . $this->_groupID . '&message=vk_api&attachments=photo' . $photoInfo->response[0]->owner_id . '_' . $photoInfo->response[0]->id . '&v=' . $this->_version . '&access_token=' . $this->_token);
    }
}
