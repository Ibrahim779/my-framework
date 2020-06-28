<?php


namespace PHPMVC\database;


use http\Exception\InvalidArgumentException;

abstract class AbstractDB implements DBInterface
{
   private static $_config = array();
   private static $_link;
   private static $_result;
   public static function connect()
   {
       $config = array(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
       if (count($config) !== 4 )
       {
           throw new InvalidArgumentException('not valid data to connect');
       }
       self::$_config = $config;

       if (self::$_link === null){
       list($host, $username, $pass, $dbname) = self::$_config;
        if (!self::$_link = mysqli_connect($host, $username, $pass, $dbname)){
            die('Connect Error'. mysqli_connect_error());
        }
        unset($host, $username, $pass, $dbname);
       }

        return self::$_link;
   }
   public static function select($table, $where = '', $fields = '*', $order = '', $limit = null, $offset = null,$like=null)
   {
       $query = 'SELECT ' . $fields . ' FROM ' . $table
                . ($where ? ' WHERE ' . $where : '')
                . ($order ? ' ORDER BY ' . $order : '')
                . (($limit) ? ' LIMIT ' . $limit : '')
                . ($offset && $limit ? ' OFFSET ' . $offset : '')
                . ($like ? ' LIKE ' . $like : '');
       self::query($query);
   }
   public static function query($query)
   {
       if(!is_string($query) && empty($query)){
           throw new InvalidArgumentException('not valid query');
       }
       self::connect();
       if (!self::$_result = mysqli_query(self::$_link, $query)){
           die('Error'. $query . mysqli_error(self::$_link));
       }
       return self::$_result;
   }
   public static function fetchAll()
   {
       if (self::$_result !== null){
           if ($all = mysqli_fetch_all(self::$_result,MYSQLI_ASSOC)){
               self::freeResult();
           }
           return json_encode($all) ;
       }
       return self::$_result;
   }
    public static function fetchRow()
    {
        if (self::$_result !== null){
            if ($row = mysqli_fetch_array(self::$_result,MYSQLI_ASSOC)){
                self::freeResult();
            }
            return json_encode($row);
        }
        return self::$_result;
    }
    protected static function freeResult()
    {
        if (self::$_result === null){
            return false ;
        }
        mysqli_free_result(self::$_result);
        return true;
    }

    public static function insert($table, array $data)
    {
        // TODO: Implement insert() method.
        $columns =implode(',',array_keys($data));
        $values =array();
        foreach (array_values($data) as $value){
            $values[] = self::checkValue($value);
        }
        $values =implode(',',$values);
        $query = 'INSERT INTO'. ' ' . $table . '(' . $columns . ')' . 'VALUES (' . $values . ')';
        self::query($query);

    }

    public static function _update($table, array $data, $where = '')
    {
        // TODO: Implement update() method.
        $set = array();
        foreach ($data as $column => $value){
            $set[] = $column . '=' . self::checkValue($value);
        }
        $set = implode(',', $set);
        $query = 'UPDATE ' . $table . ' SET ' . $set . ($where ? ' WHERE ' . $where : '');
        self::query($query);
    }

    public static function _delete($table, $where = '')
    {
        // TODO: Implement delete() method.
        $query = 'DELETE FROM'. ' ' . $table . ($where ? ' WHERE ' . $where : '');
        self::query($query);
    }
    protected static function checkValue($value)
    {
        self::connect();
       if ($value === null){
           $value = 'NULL';
       }elseif (!is_numeric($value)){
           $value =  "'" . mysqli_real_escape_string(self::$_link, $value) . "'";
       }
       return $value;

    }
    public static function disconnect()
    {
        // TODO: Implement disconnect() method.
        if (self::$_link === null){
            return false ;
        }
        mysqli_close(self::$_link);
        self::$_link = true;
        return true;
    }
    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        $this->disconnect();
    }
}