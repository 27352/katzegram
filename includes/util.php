<?php
function withQuotes($str) {
    return '"' . $str . '"';
}

function withCurlyBraces($str) {
    return '{' . $str . '}';
}

function withBrackets($str) {
    return '[' . $str . ']';
}

function assocToJson($arr) {
    $item = array();

    foreach ($arr as $key => $value) {
        // Exclude the user's password
        if ($key != "password") {
            $str = withQuotes($key) . ':' . withQuotes($value);
            array_push($item, $str);
        }
    }

    return withCurlyBraces( implode(',', $item) );
}

function dateToString($datetime) {
    $date = new DateTime($datetime);
    //return $date->format('l jS \of F Y h:i:s A');
    return $date->format('l, F jS Y');
}
?>
