<?php 

namespace app\Traits;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

/*  
|--------------------------------------------------
| Api Response Trait
|--------------------------------------------------
| This trait will be used for any response we sent to clients
|--------------------------------------------------
|
*/

trait SaveFile 
{
    /**
     * Return a success json response.
     * 
     * @return \Illumninate\Http\JsonResponse
     */
    protected function saveImage( $file, $previousImage='', $path='' ) {
        if( !empty($file) ) {
            if( !empty($previousImage) && File::exists($previousImage) ) {
                File::delete($previousImage);
            }

            if( empty($path) ) {
                $image_name = 'image/' . time() . '.' . $file->extension();
                $file->move( public_path('image/'), $image_name );
                
            } else {
                $image_name = $path . '/' . time() . '-' . $file->getClientOriginalName() . '.' . $file->extension();
                $file->move( public_path( $path . '/' ), $image_name );
            }
        } else {
            $image_name = $previousImage;
        }

        return $image_name;
    }

}