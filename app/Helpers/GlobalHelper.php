<?php

/** Check Input Error */
if(!function_exists('hasError')) {
    function hasError($errors, string $name): ?string {
        return $errors->has($name) ? 'is-invalid' : '';
    }
}

/** Set sidebar Active */
if(!function_exists('setSidebarActive')) {
    function setSidebarActive(array $routes): ?string {
        foreach($routes as $route) {
            if(request()->routeIs($route))
            return 'active';
        }
        return null;
    }
}
