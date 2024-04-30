<?php
namespace App\Ldap;

use LdapRecord\Models\Model;
use LdapRecord\Models\Concerns\CanAuthenticate;
use Illuminate\Contracts\Auth\Authenticatable;

class Users extends Authenticatable
{
    use CanAuthenticate;

    public static $objectClasses = [
        'top',
        'posixAccount',
        'inetOrgPerson',
    ];

    protected string $guidKey = 'uid';
}
