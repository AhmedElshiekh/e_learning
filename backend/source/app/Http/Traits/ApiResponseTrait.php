<?php

namespace App\Http\Traits;

use Illuminate\Support\Arr;

trait ApiResponseTrait
{
    public function page()
    {
        $numPage = request('page') ? ( request('page') == "home" ? 6 : 10 ) :  null;
        return $numPage ;
    }

    public function apiResponse($data = null, $code, $massage = 'Success', $currentPage = null, $lastPage = null)
    {
        $array = [
            'data'          =>  $data,
            'status'        =>  in_array($code, $this->successCode()) ? true : false,
            'currentPage'   =>  $currentPage,
            'lastPage'      =>  $lastPage,
            'massage'       =>  is_string($massage) ? [$massage] : $this->failedCode($massage),
        ];

        return response($array, $code);
    }

    public function successCode()
    {
        return [
            200, 201, 202
        ];
    }


    public function failedCode($msg)
    {
        $err = json_decode($msg);

        $code = [];

        foreach ($err as $k => $v) {
            if (isset($err->$k)) {
                array_push($code, $v);
            };
        }

        return   Arr::collapse($code);
    }
}
