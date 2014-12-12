<?php
require_once "lessc.inc.php";

$less = new lessc;

try {
    $less->checkedCompile("less/home.less", "css/home.css");
} catch(exception $e) {
    echo "fatal error: " . $e->getMessage();
}