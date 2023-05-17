<?php
namespace App\Http\Controllers\traid;

use App\discount;
use App\Item;
use App\Shopowner;
use Intervention\Image\Facades\Image;

trait ykimage
{
    function base64_to_image($base64_string, $output_file) {
        // open the output file for writing
        $ifp = fopen( $output_file, 'wb' );

        // split the string on commas
        // $data[ 0 ] == "data:image/png;base64"
        // $data[ 1 ] == <actual base64 string>
        $data = explode( ',', $base64_string );

        // we could add validation here with ensuring count( $data ) > 1
        fwrite( $ifp, base64_decode( $data[ 1 ] ) );

        // clean up the file resource
        fclose( $ifp );

        return 'done';
    }

    public function setthumbs($path, $imagename)
    {
       $forthumb = Image::make($path);
       $forthumb->resize(300, 300)->save(public_path('images/items/mid/') . $imagename, 60);
      $forthumb->resize(100, 100)->save(public_path('images/items/thumbs/') . $imagename, 60);
    }

    public function setthumbslogo($path, $imagename)
    {
        $forthumb = Image::make($path);
        $forthumb->resize(300, 300)->save(public_path('images/logo/mid/') . $imagename, 60);
        $forthumb->resize(100, 100)->save(public_path('images/logo/thumbs/') . $imagename, 60);
    }

    public function setthumbsbanner($path, $imagename)
    {
        $forthumb = Image::make($path);
        $forthumb->resize(300, 300)->save(public_path('images/banner/mid/') . $imagename, 60);
        $forthumb->resize(100, 100)->save(public_path('images/banner/thumbs/') . $imagename, 60);
    }
    public function setthumbsadsbanner($path, $imagename)
    {
        $forthumb = Image::make($path);
        $forthumb->resize(800, 250)->save(public_path('images/banner/mid/') . $imagename, 60);
        $forthumb->resize(500, 250)->save(public_path('images/banner/thumbs/') . $imagename, 30);
    }
}

?>
