<?php
// Responsibility: Holds an image -- either coming in from a true color image 
// in the 'image' entry or from a temporary file in the tmp_name file
class ImageData {
	private $errorCount;
	private $errors;
	private $formInput;
	private $image;
	private $imageHeight;
	private $imageWidth;
	private $sizeLimit;

	public function __construct($formInput = null, $sizeLimit = 5000000) {
		$this->formInput = $formInput;
		$this->sizeLimit = $sizeLimit;
		if (is_null($formInput))
			$this->initializeEmpty();
	    else
		    $this->initialize();
	}
	
	public function getError($errorName) {
		if (isset($this->errors[$errorName]))
			return $this->errors[$errorName];
		else
			return "";
	}
	
	public function getErrorCount() {
		return $this->errorCount;
	}
	
	public function getErrors() {
		return $this->errors;
	}
	
	public function getImage() {
		return $this->image;
	}
	
	public function setImage($image) {
		if (!imageistruecolor($image)) {
			setError("image", "Image is not a true color image");
			return;
		} 
		$oldImage = $this->image;
		$this->imageWidth = imagesx($image);
		$this->imageHeight = imagesy($image);
		$this->image = $image;
		if (!is_null($oldImage))
		   imagedestroy($oldImage);
	}
	
	public function getImageHeight() {
		return $this->imageHeight;
	}
	
	
	public function getImageWidth() {
		return $this->imageWidth;
	}
	
	public function getParameters() {
		// Return data fields as an associative array
		$paramArray = array("imageHeight" => $this->imageHeight,
		                    "imageWidth" => $this->imageWidth,
				            "image" => $this->image
		                   );
		return $paramArray;
	}
	

	public function __toString() {
		$str = "Image height:[".$this->imageHeight."]" . 
	    " Image width:[".$this->imageWidth."]";
		return $str;
	}
	
	public static function readImage($path) {
		//Reads a true color image from $path
		$image = false;
		$imageInfo = getimageSize($path);
		if ($imageInfo)  {
			switch($imageInfo[2]) {
		       case IMAGETYPE_JPEG:
				   $image = imagecreatefromjpeg($path);
			       break;
		       case IMAGETYPE_GIF:
		       	   $image = imagecreatefromgif($path);
		       	   break;
		       case IMAGETYPE_PNG:
		       	   $image = imagecreatefrompng($path);
		       	   break;
			}
		}
		return $image;
	}
	
	public static function writeImage($image, $path) {
		//Writes $image to file $path based on the extension
		if (is_null($image))
			return false;	
		$extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
		if ($extension)  {
			switch($extension) {
				case 'jpeg':
				case 'jpg':
					$functionName = 'imagejpeg';
					break;
				case 'png':
					$functionName = 'imagepng';
					break;
				case 'gif':
					$functionName = 'imagegif';
					break;
			}
		}
		try {
			$returnValue = $functionName($image, $path);
		} catch (Exception $e) {
			$returnValue = false;
		}
		return $returnValue;
	}
	
	public static function resizeImage($image, $newWidth, $newHeight) {
		$error = "";
		$resizedImage = imagecreatetruecolor($newWidth, $newHeight);
		imagecopyresampled($resizedImage, $image,
		0, 0, 0, 0, $newWidth, $newHeight, imagesx($image), imagesy($image));
		return $resizedImage;
	}
	
	public static function cropImage($image, $newAspect) {
		// Produce a new image with this aspect ratio.
		$width = imagesx($image);
		$height = imagesy($image);
		$oldAspect = $width/$height;
		if ($oldAspect == $newAspect) {
			$newImage = imagecreatetruecolor($width, $height);
			imagecopy($newImage, $image, 0, 0, 0, 0, $width, $height);
			return $newImage;
		}
		if ($oldAspect > $newAspect) {
			$cropWidth = round($width * $newAspect/$oldAspect, 0);
			$x = round(0.5*($width - $cropWidth), 0);
			$y = 0;
			$cropHeight = $height;
		} elseif ($oldAspect < $newAspect) {
			$cropHeight = round($height*$oldAspect/$newAspect, 0);
			$x = 0;
			$y = round(0.5*($height - $cropHeight), 0);
			$cropWidth = $width;
		}
		$newImage = imagecreatetruecolor($cropWidth, $cropHeight);
		$cropParameters = array('x' => $x, 'y' => $y,
				'width' => $cropWidth, 'height' => $cropHeight);
		$newImage = imagecrop($image, $cropParameters);
		return $newImage;
	}

	private function initialize() {
		$this->initializeEmpty();
		if (isset($this->formInput['tmp_name']))  
		   $this->verifyFileImage();
		else
		   $this->setError('image', 'Invalid image');	
	}
	
	private function initializeEmpty() {
		$this->errorCount = 0;
		$errors = array();
		$this->imageHeight = 0;
		$this->imageWidth = 0;
		$this->image = null;
	}
	
	private function verifyFileImage() {
		if (!file_exists($this->formInput['tmp_name'])) {
			$this->setError("image", "Image file does not exist");
			return;
		} elseif (!isset($this->formInput['size']) ||
			$this->formInput['size'] > $this->sizeLimit) {
			$this->setError("image", "Image must be less than ".$this->sizeLimit." bytes");
			return;
		}
		$image = $this->readImage($this->formInput['tmp_name']);
		if (!$image)
			$this->setError("image", "Image file does not contain a valid image");
		else
		    $this->setImage($image);
	}
	
	private function setError($type, $msg) {
		$this->errors[$type] = $msg;
		$this->errorCount++;
	}
	
	private function stripInput($data) {
		// Require most data be free of blanks, slashes and special characters
		$data = trim ( $data );
		$data = stripslashes ( $data );
		$data = htmlspecialchars ( $data );
		return $data;
	}
}
?>