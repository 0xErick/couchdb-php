<?php
namespace Couch\Core;

use Couch\Couch;
use Couch\BadCredentials;

class DB
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function __get($name)
    {
        return $this->user[$name];
    }

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
        $res = Couch::request('/' . $dbId, 'GET', array(), $authentication);

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
        $res = Couch::request('/'.$params['dbId'], 'PUT', array(), $authentication);

        if($res[0]===201||$res[0]===412){
            return true ;
        }
        return false;
    }

    public static function isProtected($params, $authentication = array())
    {
        try {
            $res = Couch::request('/' . $params['dbId'] .'/_security', 'GET', array(), $authentication);
            $flag = false;
            if (isset($res[1]['admins']) && isset($res[1]['admins']['names'])){
                $flag = in_array('admin',$res[1]['admins']['names']) && in_array($params['userId'],$res[1]['admins']['names']);
            }

            if (isset($res[1]['members']) && isset($res[1]['members']['names'])){
                $flag = in_array('admin',$res[1]['members']['names']) && in_array($params['userId'],$res[1]['members']['names']);
          
            }
            return $flag;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function setSecurity($params, $authentication = array())
    {
        try {
            $res = Couch::request('/' . $params['dbId'] .'/_security', 'PUT',$params['security'], $authentication);
            if($res[0]===200){
                return true ;
            }
        } catch (Exception $e) {
            return false;
        }
    }


}
