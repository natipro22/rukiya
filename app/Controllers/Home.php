<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if($this->request->getMethod() == 'post'){
            $data = $this->request->getVar();
            print_r($data);
        }
        return view('test');
    }
    public function tocken()
    {
        if($this->request->getMethod() == 'post'){
            $data = $this->request->getVar();
            print_r($data);
        }
        return view('test');
    }
}
