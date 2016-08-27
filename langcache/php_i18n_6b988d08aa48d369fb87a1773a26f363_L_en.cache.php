<?php class L {
const index_logo_name = 'AIRCOMPANY';
const index_contact = 'Contact Us';
const index_nav_login = 'Log in';
public static function __callStatic($string, $args) {
    return vsprintf(constant("self::" . $string), $args);
}
}
function L($string, $args=NULL) {
    $return = constant("L::".$string);
    return $args ? vsprintf($return,$args) : $return;
}