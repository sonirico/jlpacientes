<?php

if (! function_exists('load_dompdf'))
{
    function load_dompdf ()
    {
        require_once APPPATH . 'third_party/dompdf/autoload.inc.php';
    }
}

?>