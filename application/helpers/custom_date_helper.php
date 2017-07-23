<?php 

if (! function_exists('datestr_to_unix')) 
{
    function datestr_to_unix($str, $format = 'd/m/Y') {
        $date_obj = date_create_from_format($format, $str);

        return $date_obj->getTimeStamp();
    }
}

?>