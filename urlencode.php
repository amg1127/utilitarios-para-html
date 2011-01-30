#!/usr/bin/php -q
<?php
	$enco = (basename($argv[0]) != "urlencode");
        array_shift ($argv);
        if ($enco) {
		echo (urldecode (implode (" ", $argv)) . "\n");
        } else {
		echo (urlencode (implode (" ", $argv)) . "\n");
        }
?>
