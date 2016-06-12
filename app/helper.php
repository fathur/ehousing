<?php

if(! function_exists('bytesConvert'))
{
    function bytesConvert($bytes)
    {
        if ($bytes == 0)
            return "0.00";

        $s = array('', 'Rb', 'Jt', 'M', 'T', 'RT', 'MP');
        $e = floor(log($bytes, 1000));

        return round($bytes / pow(1000, $e), 1) . " " . $s[(int) $e];
    }
}