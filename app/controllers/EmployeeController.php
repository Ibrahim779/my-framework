<?php


namespace PHPMVC\Controllers;
use PHPMVC\Models\Employee;

class EmployeeController extends AbstractController
{
    public function index()
    {
      $employees = Employee::where('id',2)->like("%h")->get();
      $this->_view($employees);
    }

    public function store()
    {
         Employee::create([
             'name'    => 'test',
             'job'     => 'testJob',
             'email'   => 'test@test.com',
             'phone'   => '+20101205589',
             'address' => 'testAddress',
         ]);
    }
}
