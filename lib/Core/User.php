<?php
namespace Couch\Core;

use Couch\Couch;
use Couch\BadCredentials;

class User
{
    public static function find($userId, $options = array(), $authentication = array())
    {
        try {
            return self::findOrFail($userId, $options, $authentication);
        } catch (Exception $e) {
            return false;
        }
    }

    public static function findOrFail($userId, $options = array(), $authentication = array())
    {
        $res = Couch::request('/_users/org.couchdb.user:' . $userId, 'GET', array(), $authentication);
        if($res[0]===200){
            return true ;
        }
        return false;
    }

    public static function create($params, $authentication = array())
    {
        try {
            return self::createOrFail($params, array(), $authentication);
        } catch (Exception $e) {
            return false;
        }
    }

    public static function createOrFail($params, $options = array(), $authentication = array())
    {
       
        $res = Couch::request('/_users/org.couchdb.user:'.$params["name"], 'PUT', $params, $authentication);
        if($res[0]===201 || $res[0]==409){
            return true ;
        }
        return false;
    }
}
