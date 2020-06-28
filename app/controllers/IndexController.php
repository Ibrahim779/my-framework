<?php
namespace PHPMVC\Controllers;

class IndexController extends AbstractController
{
    public function index()
    {
      $this->_view();
    }
}