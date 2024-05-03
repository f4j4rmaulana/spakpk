<?php

use LdapRecord\Connection;

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

function check_nip_by_ldap($uname,$pass,$role="people"){
    $ldapConnection = new Connection([
        // Mandatory Configuration Options
        'hosts'            => ['10.10.160.109'],
        'base_dn'          => 'dc=big,dc=go,dc=id',
        'username'         => 'uid='.$uname.',ou='.$role.',dc=big,dc=go,dc=id',
        'password'         => $pass,

        // Optional Configuration Options
        'port'             => 389,
        'use_ssl'          => false,
        'use_tls'          => false,
        'version'          => 3,
        'timeout'          => 5,
        'follow_referrals' => false,

        // Custom LDAP Options
        'options' => [
            // See: http://php.net/ldap_set_option
            LDAP_OPT_X_TLS_REQUIRE_CERT => LDAP_OPT_X_TLS_HARD
        ]
    ]);

    try {
        $ldapConnection->connect();
        $qb1 = $ldapConnection->query()->where("uid", $uname)->get();
        // $json  = json_encode($qb1);
        return $qb1;
    } catch (\LdapRecord\Auth\BindException $e) {
        $error = $e->getDetailedError();
        // $json  = json_encode($error);
    return [];
    }
}
