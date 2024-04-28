<?php

/** Check Input Error */
if(!function_exists('hasError')) {
    function hasError($errors, string $name): ?string {
        return $errors->has($name) ? 'is-invalid' : ''; 
    }
}
