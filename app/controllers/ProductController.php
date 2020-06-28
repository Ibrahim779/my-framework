<?php


namespace PHPMVC\Controllers;


use PHPMVC\Models\Product;

class ProductController extends AbstractController
{
  public function index()
  {
      $this->_data['e'] = Product::all();
      $this->_view();
  }
}