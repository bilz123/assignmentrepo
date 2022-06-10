<?php 

function myTestFunction($imageData){

    $data = [];
    $image = $imageData;
    
        $fileName    = time().'.'.$image->getClientOriginalExtension();
        
        $img = Image::make($image->getRealPath());
       
        $img->resize(120, 120, function ($constraint) {
            $constraint->aspectRatio();                 
        });

        $img->stream(); // <-- Key point

        Storage::disk('local')->put('public/images'.'/'.$fileName, $img, 'public');
      
        return  $fileName;
}

      

?>