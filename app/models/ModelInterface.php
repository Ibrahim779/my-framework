<?php


namespace PHPMVC\Models;


interface ModelInterface
{

  public static function all();
  public  function get();
  public static function find($id);
  public static function where($column, $value);
  public static function orderBy($column, $order = 'ASC');
  public static function limit($limit, $offset = null);
  public static function like($like);
  public static function create($data);
  public static function update($data, $id);
  public static function delete($id);

}