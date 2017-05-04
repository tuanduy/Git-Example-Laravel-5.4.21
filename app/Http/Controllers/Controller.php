<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function testAction()
    {
      echo "This is action testAction from class Controller";
    }
    public function testIdentification()
    {
      return redirect()->route("ide");
    }
    public function testActionValue($val1, $val2)
    {
      echo " This value of test action variable: ".$val1.$val2;
    }
}
