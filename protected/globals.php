<?php

function dump($target, $depth = 10)
{
	CVarDumper::dump($target, $depth, true);

	if (is_int($target) and $target >= 946702800 and $target < 1577854800) // 2000 to 2020, I think it's a date
		CVarDumper::dump(date('r', $target), $depth, true);

	echo '<br />';
	flush();
}

// Function to sort two-dimentional array
// array_msort($array, array('first sort attr' => SORT_DESC, 'second sort attr' => SORT_ASC));
// sort attribute is key from array which inside $array
function array_msort($array, $cols)
{
	$colarr = array();

	foreach ($cols as $col => $order)
	{
		$colarr[$col] = array();
		foreach ($array as $k => $row)
		{
			$colarr[$col]['_' . $k] = strtolower($row[$col]);
		}
	}

	$eval = 'array_multisort(';

	foreach ($cols as $col => $order)
	{
		$eval .= '$colarr[\'' . $col . '\'],' . $order . ',';
	}

	$eval = substr($eval, 0, -1) . ');';

	eval($eval);

	$ret = array();

	foreach ($colarr as $col => $arr)
	{
		foreach ($arr as $k => $v)
		{
			$k = substr($k, 1);

			if (!isset($ret[$k]))
				$ret[$k] = $array[$k];

			$ret[$k][$col] = $array[$k][$col];
		}
	}

	return $ret;
}

/**
 * Temporary image resize before save
 * @param int $width required width
 * @param int $height required height
 * @param obj $image CUploadedFile object
 * @param int $quality quality of resized image from 0 to 100 (default = 100)
 */
function tempImageResize($width, $height, $image, $quality = 100)
{
	//dump($image->type);exit;
	if (!($image->type == 'image/jpeg' or $image->type == 'image/png' or $image->type == 'image/gif'))
		return false;
	
	/* Get original image x y */
	list($w, $h) = getimagesize($image->tempName);

	/* calculate new image size with ratio */
	$ratio = max($width / $w, $height / $h);
	$h = ceil($height / $ratio);
	$x = ($w - $width / $ratio) / 2;
	$w = ceil($width / $ratio);
	
	/* read binary data from image file */
	$imgString = file_get_contents($image->tempName);
	/* create image from string */
	$imageNew = imagecreatefromstring($imgString);
	$tmp = imagecreatetruecolor($width, $height);
	imagecopyresampled($tmp, $imageNew, 0, 0, $x, 0, $width, $height, $w, $h);
	/* Save image */
	
	switch ($image->type)
	{
		case 'image/jpeg':
			imagejpeg($tmp, $image->tempName, $quality);
			break;
		case 'image/png':
			imagepng($tmp, $image->tempName, (9 - floor($quality/11)));
			break;
		case 'image/gif':
			imagegif($tmp, $image->tempName);
			break;
		default:
			exit;
			break;
	}
	
	/* cleanup memory */
	imagedestroy($imageNew);
	imagedestroy($tmp);
}
