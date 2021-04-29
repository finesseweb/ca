<?php
## function to create thumbnail of size 200,200 of jpeg/png 
class UploadComponent extends Component  {
var $allowableTypes = array(
        IMAGETYPE_GIF,
        IMAGETYPE_JPEG,
        IMAGETYPE_PNG
    );

    public function imageCreateFromFile($filename, $imageType) {

        switch($imageType) {
            case IMAGETYPE_GIF  : return imagecreatefromgif($filename);
            case IMAGETYPE_JPEG : return imagecreatefromjpeg($filename);
            case IMAGETYPE_PNG  : return imagecreatefrompng($filename);
            default             : return false;
        }

    }

    /**
     * Generates a thumbnail image using the file at $sourceFilename and either writing it
     * out to a new file or directly to the browser.
     *
     * @param string $sourceFilename Filename for the image to have thumbnail made from
     * @param integer $maxWidth The maxium width for the resulting thumbnail
     * @param integer $maxHeight The maxium height for the resulting thumbnail
     * @param string $targetFormatOrFilename Either a filename extension (gif|jpg|png) or the
     *   filename the resulting file should be written to. This is optional and if not specified
     *   will send a jpg to the browser.
     * @return boolean true if the image could be created, false if not
     */
    public function generate($sourceFilename, $maxWidth, $maxHeight, $targetFormatOrFilename = 'jpg') {

        $size = getimagesize($sourceFilename); // 0 = width, 1 = height, 2 = type

        // check to make sure source image is in allowable format
        if(!in_array($size[2], $this->allowableTypes)) {
            return false;
        }

        // work out the extension, what target filename should be and output function to call
        $pathinfo = pathinfo($targetFormatOrFilename);
        if($pathinfo['basename'] == $pathinfo['filename']) {
            $extension = strtolower($targetFormatOrFilename);
            // set target to null so writes out to browser
            $targetFormatOrFilename = null;
        }
        else {
            $extension = strtolower($pathinfo['extension']);
        }

        switch($extension) {
            case 'gif' : $function = 'imagegif'; break;
            case 'png' : $function = 'imagepng'; break;
            default    : $function = 'imagejpeg'; break;
        }

        // load the image and return false if didn't work
        $source = $this->imageCreateFromFile($sourceFilename, $size[2]);
        if(!$source) {
            return false;
        }

        // write out the appropriate HTTP headers if going to browser
        if($targetFormatOrFilename == null) {
            if($extension == 'jpg') {
                header("Content-Type: image/jpeg");
            }
            else {
                header("Content-Type: image/$extension");
            }
        }

        // if the source fits within the maximum then no need to resize
        if($size[0] <= $maxWidth && $size[1] <= $maxHeight) {
            $function($source, $targetFormatOrFilename);
        }
        else {

            $ratioWidth = $maxWidth / $size[0];
            $ratioHeight = $maxHeight / $size[1];

            // use smallest ratio
            if($ratioWidth < $ratioHeight) {
                $newWidth = $maxWidth;
                $newHeight = round($size[1] * $ratioWidth);
            }
            else {
                $newWidth = round($size[0] * $ratioHeight);
                $newHeight = $maxHeight;
            }

            $target = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($target, $source, 0, 0, 0, 0, $newWidth, $newHeight, $size[0], $size[1]);
            $function($target, $targetFormatOrFilename);

        }

        return true;

    }
	
	
	function uploadimg($file,$destinationorig,$destinationthumb,$widththumb,$heightthumb) {
		
		$today=rand(99999999,5);//date('Y-m-d H:i:s');
		$var1=substr(md5($today),0,10);
		$imageupload=$file;
                //print_r($file);
                //die();
		$pimage_filename=basename($imageupload['name']);
		$pimage_filename=str_replace(" " , "" , $pimage_filename);
		
	
		
		$uploadfile = $destinationorig.$var1."_".$pimage_filename;
		$imageName=$var1."_".$pimage_filename;
     
			if(move_uploaded_file($file['tmp_name'],$uploadfile))
			{
                         // print_r($imageName);die();   
			if($destinationthumb!=""){
			$this->generate($destinationorig.$imageName,$widththumb,$heightthumb, $destinationthumb.$imageName);
			}
                      
			return $imageName;
			
			}
			else
			{
			return false;
			}
		}
		
		function uploadPdf($file,$destinationpath) {
		
		$today=rand(99999999,5);//date('Y-m-d H:i:s');
		$var1=substr(md5($today),0,10);
		$imageupload=$file;
		$pimage_filename=basename($imageupload['name']);
		$pimage_filename=str_replace(" " , "" , $pimage_filename);
		
	
		
		$uploadfile = $destinationpath.$var1."_".$pimage_filename;
		$imageName=$var1."_".$pimage_filename;

			if(@move_uploaded_file($file['tmp_name'],$uploadfile))
			{
			return $imageName;
			
			}
			else
			{
			return false;
			}
		}
		
	function uploadMultipleImg($name,$temp,$destinationorig,$destinationthumb,$widththumb,$heightthumb) {
		
		$today=rand(99999999,5);//date('Y-m-d H:i:s');
		$var1=substr(md5($today),0,10);
		$imageupload=$name;
		$pimage_filename=basename($name);
		$pimage_filename=str_replace(" " , "" , $pimage_filename);
		
	
		
		$uploadfile = $destinationorig.$var1."_".$pimage_filename;
		$imageName=$var1."_".$pimage_filename;

			if(@move_uploaded_file($temp,$uploadfile))
			{
			if($destinationthumb!=""){
			$this->generate($destinationorig.$imageName,$widththumb,$heightthumb,$destinationthumb.$imageName);
			}
			return $imageName;
			
			}
			else
			{
			return false;
			}
		}
	
	}
?>