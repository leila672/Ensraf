<?php

namespace App\Traits;

trait api_return
{

    public function getCurrentLang()
    {
        return app()->getLocale();
    }

    public function returnError($errNum, $msg)
    {
        return response()->json([
            'status' => false,
            'errNum' => $errNum,
            'msg' => $msg
        ],401);
    }


    public function returnSuccessMessage($msg = "")
    {
        return response()->json([
            'status' => true,
            'errNum' => "200",
            'msg' => $msg
        ],200);
    }

    public function returnData($value, $msg = "")
    {
        return response()->json([
            'status' => true,
            'errNum' => "200",
            'msg' => $msg,
            'data' => $value
        ],200);
    }

    public function returnPaginationData($value,$paginator, $msg = "")
    {
        return response()->json([
            'status' => true,
            'errNum' => "200",
            'msg' => $msg,
            'data' => $value,
            'pagination' => [
                'links' =>[
                    'first' => $paginator->url(1),
                    'last' => $paginator->url($paginator->lastPage()),
                    'prev' => $paginator->previousPageUrl(),
                    'next' => $paginator->nextPageUrl()
                ],
                'meta' => [
                    'current_page' => $paginator->currentPage(),
                    'from' => $paginator->firstItem(),
                    'to' => $paginator->lastItem(),
                    'last_page' => $paginator->lastPage(),
                    'total_items_in_current_page' => $paginator->count(),
                    'items_per_page' => $paginator->perPage(),
                    'total_pages' => $paginator->lastPage(),
                    'total_items' => $paginator->total()
                ]
            ]
        ],200);
    }


}
