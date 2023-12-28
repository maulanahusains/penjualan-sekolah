<?php

function IDGenerator($model, $trow, $length = 4, $prefix) {
    $data = $model::orderBy('id', 'desc')->first();

    if(!$data){
        $code_length = $length - 1;
        $last_number = '1';
    } else {
        $code_without_prefix = substr($data->$trow, strlen($prefix) + 1);
        $get_last_number = ($code_without_prefix/1)*1;
        $last_number_length = strlen($get_last_number);
        $code_length = $length - $last_number_length;
        $last_number = $get_last_number + 1;
    }

    $zeros = '';
    for($i = 0; $i < $code_length; $i++) {
        $zeros .= '0';
    }

    return $prefix.'-'.$zeros.$last_number;
}