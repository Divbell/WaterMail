<?php
require_once "lessc.inc.php";

$less = new lessc;

try {
    $less->checkedCompile("less/ex.less", "css/ex.css");
} catch(exception $e) {
    echo "fatal error: " . $e->getMessage();
}