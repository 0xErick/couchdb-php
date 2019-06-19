<?php
namespace Couch;

class Couch
{
    const VERSION           = '2.3.1';
    const USER_AGENT_ORIGIN = 'CouchDB PHP Library';

    public static $host = '';
    public static $authorization  = '';
    public static $curlopt_ssl_verifypeer = FALSE;

    public static function config($authentication)
    {
        if (isset($authentication['Authorization']))
            self::$authorization = $authentication['Authorization'];

        if (isset($authentication['curlopt_ssl_verifypeer']))
            self::$curlopt_ssl_verifypeer = $authentication['curlopt_ssl_verifypeer'];

        if (isset($authentication['host']))
            self::$host = $authentication['host'];
    }

    public static function request($url, $method = 'POST', $params = array(), $authentication = array())
    {
        $authorization  = isset($authentication['authorization']) ? $authentication['authorization'] : self::$authorization;
        $curlopt_ssl_verifypeer = isset($authentication['curlopt_ssl_verifypeer']) ? $authentication['curlopt_ssl_verifypeer'] : self::$curlopt_ssl_verifypeer;
        $host = isset($authentication['host']) ? $authentication['host'] : self::$host;

        # Check if credentials was passed
        if (empty($authorization))
            \Couch\Exception::throwException(400, array('reason' => 'CredentialsMissing', 'message' => 'basic auth missing'));
         # Check if host was passed
        if (empty($host))
            \Couch\Exception::throwException(400, array('reason' => 'HostMissing', 'message' => 'host missing'));

        $url       = $host . $url;
        $headers   = array();
        $headers[] = 'Authorization: ' . $authorization;
        $curl      = curl_init();

        $curl_options = array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL            => $url
        );

        if ($method == 'POST') {
            $headers[] = 'Content-Type: application/json';
            array_merge($curl_options, array(CURLOPT_POST => 1));
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));
        }

        if ($method == 'PUT') {
            $headers[] = 'Content-Type: application/json';
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));
        }


        curl_setopt_array($curl, $curl_options);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, $curlopt_ssl_verifypeer);

        $response    = json_decode(curl_exec($curl), TRUE);
        $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);


        // var_dump($response);
        var_dump($http_status);
        return [$http_status,$response];
    }
}
