<?php

if(!function_exists('rupiah')) {
    function rupiah($v): string
    {
        return "Rp " . number_format($v,2,',','.');
    }
}
