## Installation

Follow these instructions to set up and run the project locally on your machine.

### Prerequisites

- [Git](https://git-scm.com/)
- [Composer](https://getcomposer.org/)
- [PHP](https://www.php.net/)

### Installation

1. Clone the repository:

```bash
   git clone https://github.com/f4j4rmaulana/spakpk.git
```
 ```bash
   cd spakpk
```

 ```bash
composer install
```
 ```bash
cp .env.example .env
```
```bash
php artisan key:generate
 ```
 ```bash
 php artisan migrate:fresh --seed
```
 ```bash
 php artisan serve
```

## Admin Credentials
localhost/admin/login
Email: 
```bash 
admin@admin.com
```
Password: 
```bash
admin@admin.com
```

## User Credentials
localhost/login
Username: 
```bash 
ldap username
```
Password: 
```bash
ldap password
```

## Created by Fajar Maulana
