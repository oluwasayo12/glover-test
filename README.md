## Glover TakeHome
Using Laravel 8 PHP framework, an administrative
system that makes use of maker-checker rules for creating, updating and deleting user data.
This is API only,

## Setup
- Clone Repository
- Run "composer install"
- Run "php artisan migrate"
- Run "php artisan db:seed" to seed default admin users with their roles and permissions
- Default credentials can be found below
- Copy .env.example content to .env

## View only access
    "email": "super_admin@glover.com",
    "password":"gloversuperadmin"

## Make Request and View Request Access
    "email": "create_request@glover.com",
    "password":"glovercreateadmin"

## Process(approve or decline) Request Access
    "email": "update_request_status_admin@glover.com",
    "password":"gloverupdaterequestadmin"