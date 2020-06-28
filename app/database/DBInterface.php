<?php


namespace PHPMVC\database;


interface DBInterface
{

  public static function connect();
  public static function select($table, $fields = '*', $where = '', $order = '', $limit = null, $offset = null);
  public static function insert($table, array $data);
  public static function _update($table, array $data, $where = '');
  public static function _delete($table, $where = '');
  public static function query($query);
  public static function fetchAll();
  public static function fetchRow();
  public static function disconnect();
  public function __destruct();

}