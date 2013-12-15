<?php

header('Content-Type: text/plain');
var_dump(
    ini_get('session.cookie_lifetime'),
    ini_get('session.gc_maxlifetime'),
    ini_get('session.gc_probability'),
    ini_get('session.gc_divisor')
);

?>