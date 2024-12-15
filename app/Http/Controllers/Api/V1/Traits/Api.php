<?php

namespace App\Http\Controllers\Api\V1\Traits ;

trait  Api{

  public function apiResponse($data = [], $status = 200)
  {
    return response()->json($data, $status);
  }

}







