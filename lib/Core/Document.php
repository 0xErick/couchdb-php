<?php
namespace Couch\Core;

use Couch\Couch;
use Couch\BadCredentials;

class Document
{
    public static function find($dbId, $options = array(), $authentication = array())
    {
        try {
            return self::findOrFail($dbId, $options, $authentication);
        } catch (Exception $e) {
            return false;
        }
    }

    public static function findOrFail($dbId, $options = array(), $authentication = array())
    {
        $res = Couch::request('/' . $dbId .'/_find', 'POST', $options, $authentication);
        if($res[0]===200){
            return $res[1];
        }
        return false;
    }
 
}
