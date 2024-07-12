<?php 

namespace app\Traits;

use Carbon\Carbon;

/*  
|--------------------------------------------------
| Api Response Trait
|--------------------------------------------------
| This trait will be used for any response we sent to clients
|--------------------------------------------------
|
*/

trait ApiResponse 
{
    /**
     * Return a success json response.
     * 
     * @param array|string $data
     * @param string $message
     * @param int|null $code
     * @return \Illumninate\Http\JsonResponse
     */
    protected function success( $data, string $message=null, int $code = 200) {
        return response()->json([
            'status' => 'Success',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * Return a error json response.
     * 
     * @param array|string $data
     * @param string $message
     * @param int|null $code
     * @return \Illumninate\Http\JsonResponse
     */
    protected function error( $data, string $message=null, int $code = 200) {
        return response()->json([
            'status' => 'Error',
            'message' => $message,
            'data' => $data
        ], $code);
    }
}