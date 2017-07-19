<?php 

if (! function_exists('redirect'))
{
    function redirect ($uri = '', $method = 'location', $code = 302)
    {
        if('refresh' === $method)
        {
            header("Refresh:0;url=".$uri);
        }
        else
        {
            header("Location: ".$uri, TRUE, $code);
        }

        exit;
    }
}

?>