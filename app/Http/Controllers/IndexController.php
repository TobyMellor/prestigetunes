<?php

namespace App\Http\Controllers;

class IndexController extends Controller
{

    public function __construct(TestController $testing)
    {  
        $this->testing = $testing;
    }

    public function showDashboard()
    {
        $fooBar = $this->testing->testing();
        echo $fooBar;
    }
}
