<?php
function antispam($string){

$patterns[1] = '/(https|http|ftp)\:\/\/|([a-z0-9A-Z]+\.[a-z0-9A-Z]+\.[a-zA-Z]{2,4})|([a-z0-9A-Z]+\.[a-zA-Z]{2,4})|\?([a-zA-Z0-9]+[\&\=\#a-z]+)/i';
$patterns[0] = '/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';

$replacements[1] = " URL SPAM ";
$replacements[0] = " E-Mail SPAM";

ksort($patterns);
ksort($replacements);
return preg_replace($patterns, $replacements, $string);
}
?>
