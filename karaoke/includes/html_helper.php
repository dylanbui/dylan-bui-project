<?php  

if ( ! function_exists('h'))
{
    function h($str)
    {
        return nl2br(htmlspecialchars($str));
    }
}

if ( ! function_exists('n'))
{
    function n($str)
    {
        return number_format($str, 2, '.', ',');
    }
}

if ( ! function_exists('now_to_mysql'))
{
    function now_to_mysql()
    {
        return date('Y-m-d H:i:s');
    }
}
if ( ! function_exists('mysql_to_fulldate'))
{
    function mysql_to_fulldate($date)
    {
        if(empty($date) || $date=='0000-00-00 00:00:00')
            return '';
        return date("yyyy-mm-dd hh:MM:ss", strtotime($date));
    }
}
