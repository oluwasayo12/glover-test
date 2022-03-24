## Glover TakeHome
Using Laravel 8 PHP framework, an administrative
system that makes use of maker-checker rules for creating, updating and deleting user data.
This is API only,

## Setup
- Database is using sqlite. Create a file with name "database.sqlite" in folder "database" before proceeding
- Clone Repository
- Run "composer install"
- Run "php artisan migrate"
- Run "php artisan db:seed" to seed default admin users with their roles and permissions
- Default credentials can be found below
- Copy .env.example content to .env
- To run tests "php artisan test"

## View only access
    "email": "super_admin@glover.com",
    "password":"gloversuperadmin"

## Make Request and View Request Access
    "email": "create_request@glover.com",
    "password":"glovercreateadmin"

## Process(approve or decline) Request Access
    "email": "update_request_status_admin@glover.com",
    "password":"gloverupdaterequestadmin"