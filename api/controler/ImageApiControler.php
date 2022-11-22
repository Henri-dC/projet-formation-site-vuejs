<?php

/* 
In this controller : -loadImg
                     -nameControl
                     -convertImage
                     -deleteImg
*/

class ImageApiControler{

    public function loadImg($img){
       $this->convertImage($img);
    }

    public function nameControl($name){
        $name  = str_replace(' ', '-', $name);
        return $name;
    }

    public function convertImage($img){

          $imagename  = $this->nameControl($img['name']);
          $source = $img['tmp_name'];
          $imagepath = $imagename;

         
          $save = '../src/assets/images/' . $imagepath; 
          move_uploaded_file($source, '../src/assets/images/'.$imagepath);
         
          $info = getimagesize('../src/assets/images/'.$imagepath);
          $mime = $info['mime'];
         
          switch ($mime) {
              case 'image/jpeg':
                  $image_create_func = 'imagecreatefromjpeg';
                  $image_save_func = 'imagejpeg';
                  break;
              case 'image/png':
                  $image_create_func = 'imagecreatefrompng';
                  $image_save_func = 'imagepng';
                  break;
              case 'image/gif':
                  $image_create_func = 'imagecreatefromgif';
                  $image_save_func = 'imagegif';
                  break;
              case 'image/webp':
                  $image_create_func = 'imagecreatefromwebp';
                  $image_save_func = 'imagewebp';
                  break;
              default: 
                  throw new Exception('Unknown image type.');
          }
            
          list($width, $height) = getimagesize('../src/assets/images/'.$imagepath);
          $modwidth = 600;  //target width
          $diff = $width / $modwidth;
          $modheight = $height / $diff;
          $tn = imagecreatetruecolor($modwidth, $modheight) ;
          $image = $image_create_func('../src/assets/images/'.$imagepath) ;
          imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ;
          $image_save_func($tn, $save) ;
              
    }

    public function deleteImg(Request $request):Response{
        $picture = $request->getQueryParam('name');
        $photoDir = '../src/assets/images/';
        $photoPath = $photoDir . $picture;
        unlink($photoPath);

        $response = new Response;
        $response->setHttpStatusCode(HttpStatusCode::OK);
        return $response;
    }
}