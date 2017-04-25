<?php
function dump($target, $depth = 10)
{
    CVarDumper::dump($target, $depth, true);

    if (is_int($target) and $target >= 946702800 and $target < 1577854800) // 2000 to 2020, I think it's a date
        CVarDumper::dump(date('r', $target), $depth, true);

    echo '<br />';
    flush();
}