function transform_HTML($string, $length = null) {
// Helps prevent XSS attacks
    // Remove dead space.
    $string = trim($string);
    // Prevent potential Unicode codec problems.
    $string = utf8_decode($string);
    // HTMLize HTML-specific characters.
    $string = htmlentities($string, ENT_NOQUOTES);
    $string = str_replace("#", "&#35;", $string);
    $string = str_replace("%", "&#37;", $string);
    $length = intval($length);
    if ($length > 0) {
        $string = substr($string, 0, $length);
    }
    return $string;
}
