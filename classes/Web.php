<?php

class Web
{
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

        $result = json_decode( curl_exec( $ch ) );
        curl_close($ch);

        return $result;
    }
}
