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
        $str = withQuotes($key) . ':' . withQuotes($value);
        array_push($item, $str);
    }

    return withCurlyBraces( implode(',', $item) );
}

?>
