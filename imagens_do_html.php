#!/usr/bin/php -q
<?php
    if ($argc != 2) {
        die ("Necessario passar a URL em linha de comando!\n");
    }
    $cont = "";
    $url = $argv[1];
    if (preg_match ("/^([^?#]*)[?#]/", $url, $m)) {
        $url = $m[1];
    }
    if (preg_match ("/^(https?:\\/\\/[^\\/]*)\\//i", $url, $m)) {
        $domain = $m[1];
    } else {
        die ("URL invalida! Nome de dominio nao-reconhecido!\n");
    }
    if (preg_match ("/^(.*\\/)[^\\/]*\$/", $url, $m)) {
        $urlpath = $m[1];
    } else {
        die ("URL invalida! Caminho nao reconhecido!\n");
    }
    while (! feof (STDIN)) {
        $cont .= fread (STDIN, 1024);
    }
    if (preg_match_all ("/<\\s*img\\s+[^>]*src=['\"]?([^\\s'\"]+)['\"]?\\s*[^>]*>/i", $cont, $matches, PREG_PATTERN_ORDER)) {
        foreach ($matches[1] as $img) {
            if (preg_match ("/^https?:\\/\\//i", $img)) {
                echo ($img . "\n");
            } else if (substr ($img, 0, 2) == "//") {
                echo ("http:" . $img . "\n");
            } else if (substr ($img, 0, 1) == "/") {
                echo ($domain . $img . "\n");
            } else {
                echo ($urlpath . $img . "\n");
            }
        }
    }
?>
