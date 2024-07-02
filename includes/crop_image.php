<?php
if (isset($_POST['username']) && isset($_POST['nbr_image'])) {
	if (!empty($_POST['username']) && !empty($_POST['nbr_image'])) {
		if ($_POST['nbr_image'] >= 1) {
			if (isset($_POST['image_type_one']) && isset($_POST['image_size_type_one']) && isset($_POST['crop_marge_one'])) {
				if (!empty($_POST['image_type_one']) && !empty($_POST['image_size_type_one']) && !empty($_POST['crop_marge_one'])) {
					if ($_POST['image_type_one'] == 1) {
						$type = 'gif';
					}
					elseif ($_POST['image_type_one'] == 2) {
						$type = 'jpeg';
					}
					elseif ($_POST['image_type_one'] == 3) {
						$type = 'png';
					}
					$currentImagename = 'test/'+ $_POST['username'] + '.' + $type;
					$newImagename = 'test/'+ $_POST['username'] + '.' + $type;

					$currentimageSize = getimagesize($currentImagename);
					$currentWidth = $currentimageSize[0];
					$currentHeight = $currentimageSize[1];

					if ($_POST['image_size_type_one'] = 0) {
						$cropWidth = $currentWidth;
						$cropHeight = $currentWidth;
						$left = 0;
						$top = $_POST['crop_marge_one'];
					}
					elseif ($_POST['image_size_type_one'] = 1) {
						$cropWidth = $currentHeight;
						$cropHeight = $currentHeight;
						$top = 0;
						$left = $_POST['crop_marge_one'];
					}

					$canvas = imagecreatetruecolor($cropWidth, $cropHeight);
					if ($_POST['image_type_one'] == 'gif') {
						$currentImage = imagecreatefromgif($currentImagename);
					}
					elseif ($_POST['image_type_one'] == 'jpeg') {
						$currentImage = imagecreatefromjpeg($currentImagename);
					}
					elseif ($_POST['image_type_one'] == 'png') {
						$currentImage = imagecreatefrompng($currentImagename);
					}
					imagecopy($canvas, $currentImage,0,0,$left,$top,$currentWidth,$currentHeight);
					if ($_POST['image_type_one'] == 'gif') {
						imagegif($canvas,$newImagename,100);
					}
					elseif ($_POST['image_type_one'] == 'jpeg') {
						imagejpeg($canvas,$newImagename,100);
					}
					elseif ($_POST['image_type_one'] == 'png') {
						imagepng($canvas,$newImagename,100);
					}
				}
			}
		}
		else{
			echo('error_type_one')
		}
		if ($_POST['nbr_image'] >= 2) {
			if (isset($_POST['image_type_two']) && isset($_POST['image_size_type_two']) && isset($_POST['crop_marge_two'])) {
				if (!empty($_POST['image_type_two']) && !empty($_POST['image_size_type_two']) && !empty($_POST['crop_marge_two'])) {
					if ($_POST['image_type_two'] == 1) {
						$type = 'gif';
					}
					elseif ($_POST['image_type_two'] == 2) {
						$type = 'jpeg';
					}
					elseif ($_POST['image_type_two'] == 3) {
						$type = 'png';
					}
					$currentImagename = 'test/'+ $_POST['username'] + '.' + $type;
					$newImagename = 'test/'+ $_POST['username'] + '.' + $type;

					$currentimageSize = getimagesize($currentImagename);
					$currentWidth = $currentimageSize[0];
					$currentHeight = $currentimageSize[1];

					if ($_POST['image_size_type_two'] = 0) {
						$cropWidth = $currentWidth;
						$cropHeight = $currentWidth;
						$left = 0;
						$top = $_POST['crop_marge_two'];
					}
					elseif ($_POST['image_size_type_two'] = 1) {
						$cropWidth = $currentHeight;
						$cropHeight = $currentHeight;
						$top = 0;
						$left = $_POST['crop_marge_two'];
					}

					$canvas = imagecreatetruecolor($cropWidth, $cropHeight);
					if ($_POST['image_type_two'] == 'gif') {
						$currentImage = imagecreatefromgif($currentImagename);
					}
					elseif ($_POST['image_type_two'] == 'jpeg') {
						$currentImage = imagecreatefromjpeg($currentImagename);
					}
					elseif ($_POST['image_type_two'] == 'png') {
						$currentImage = imagecreatefrompng($currentImagename);
					}
					imagecopy($canvas, $currentImage,0,0,$left,$top,$currentWidth,$currentHeight);
					if ($_POST['image_type_two'] == 'gif') {
						imagegif($canvas,$newImagename,100);
					}
					elseif ($_POST['image_type_two'] == 'jpeg') {
						imagejpeg($canvas,$newImagename,100);
					}
					elseif ($_POST['image_type_two'] == 'png') {
						imagepng($canvas,$newImagename,100);
					}
				}
			}
		}
		if ($_POST['nbr_image'] >= 3) {
			if (isset($_POST['image_type_three']) && isset($_POST['image_size_type_three']) && isset($_POST['crop_marge_three'])) {
				if (!empty($_POST['image_type_three']) && !empty($_POST['image_size_type_three']) && !empty($_POST['crop_marge_three'])) {
					if ($_POST['image_type_three'] == 1) {
						$type = 'gif';
					}
					elseif ($_POST['image_type_three'] == 2) {
						$type = 'jpeg';
					}
					elseif ($_POST['image_type_three'] == 3) {
						$type = 'png';
					}
					$currentImagename = 'test/'+ $_POST['username'] + '.' + $type;
					$newImagename = 'test/'+ $_POST['username'] + '.' + $type;

					$currentimageSize = getimagesize($currentImagename);
					$currentWidth = $currentimageSize[0];
					$currentHeight = $currentimageSize[1];

					if ($_POST['image_size_type_three'] = 0) {
						$cropWidth = $currentWidth;
						$cropHeight = $currentWidth;
						$left = 0;
						$top = $_POST['crop_marge_three'];
					}
					elseif ($_POST['image_size_type_three'] = 1) {
						$cropWidth = $currentHeight;
						$cropHeight = $currentHeight;
						$top = 0;
						$left = $_POST['crop_marge_three'];
					}

					$canvas = imagecreatetruecolor($cropWidth, $cropHeight);
					if ($_POST['image_type_three'] == 'gif') {
						$currentImage = imagecreatefromgif($currentImagename);
					}
					elseif ($_POST['image_type_three'] == 'jpeg') {
						$currentImage = imagecreatefromjpeg($currentImagename);
					}
					elseif ($_POST['image_type_three'] == 'png') {
						$currentImage = imagecreatefrompng($currentImagename);
					}
					imagecopy($canvas, $currentImage,0,0,$left,$top,$currentWidth,$currentHeight);
					if ($_POST['image_type_three'] == 'gif') {
						imagegif($canvas,$newImagename,100);
					}
					elseif ($_POST['image_type_three'] == 'jpeg') {
						imagejpeg($canvas,$newImagename,100);
					}
					elseif ($_POST['image_type_three'] == 'png') {
						imagepng($canvas,$newImagename,100);
					}
				}
			}
		}
		if ($_POST['nbr_image'] == 4) {
			if (isset($_POST['image_type_four']) && isset($_POST['image_size_type_four']) && isset($_POST['crop_marge_four'])) {
				if (!empty($_POST['image_type_four']) && !empty($_POST['image_size_type_four']) && !empty($_POST['crop_marge_four'])) {
					if ($_POST['image_type_four'] == 1) {
						$type = 'gif';
					}
					elseif ($_POST['image_type_four'] == 2) {
						$type = 'jpeg';
					}
					elseif ($_POST['image_type_four'] == 3) {
						$type = 'png';
					}
					$currentImagename = 'test/'+ $_POST['username'] + '.' + $type;
					$newImagename = 'test/'+ $_POST['username'] + '.' + $type;

					$currentimageSize = getimagesize($currentImagename);
					$currentWidth = $currentimageSize[0];
					$currentHeight = $currentimageSize[1];

					if ($_POST['image_size_type_four'] = 0) {
						$cropWidth = $currentWidth;
						$cropHeight = $currentWidth;
						$left = 0;
						$top = $_POST['crop_marge_four'];
					}
					elseif ($_POST['image_size_type_four'] = 1) {
						$cropWidth = $currentHeight;
						$cropHeight = $currentHeight;
						$top = 0;
						$left = $_POST['crop_marge_four'];
					}

					$canvas = imagecreatetruecolor($cropWidth, $cropHeight);
					if ($_POST['image_type_four'] == 'gif') {
						$currentImage = imagecreatefromgif($currentImagename);
					}
					elseif ($_POST['image_type_four'] == 'jpeg') {
						$currentImage = imagecreatefromjpeg($currentImagename);
					}
					elseif ($_POST['image_type_four'] == 'png') {
						$currentImage = imagecreatefrompng($currentImagename);
					}
					imagecopy($canvas, $currentImage,0,0,$left,$top,$currentWidth,$currentHeight);
					if ($_POST['image_type_four'] == 'gif') {
						imagegif($canvas,$newImagename,100);
					}
					elseif ($_POST['image_type_four'] == 'jpeg') {
						imagejpeg($canvas,$newImagename,100);
					}
					elseif ($_POST['image_type_four'] == 'png') {
						imagepng($canvas,$newImagename,100);
					}
				}
			}
		}
	}
}

?>