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