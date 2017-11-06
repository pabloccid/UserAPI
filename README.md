### Installation
Composer is required in order to install this project:
```bash
cd UserAPI_root_dir
composer install
```

### Configuration

The .env file contains your base configuration and must be set correctly because you will be setting the application's
configuration. An example of the file:

```bash
APP_NAME=UserAPI
APP_ENV=dev
APP_KEY=base64:Twj0dpWhB5Z6MfXUWjbNbz+ety5iNX0lFnNBbXlG9Y4=
APP_DEBUG=false
APP_LOG_LEVEL=info
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=api
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync
```

#### Initializing the database
```bash
cd UserAPI_root_dir
php artisan migrate
```

If you want some demo data to play with, you should run the following commands:
```bash
php artisan db:seed
```

### Testing

Phpunit is required. 
In order to execute every unit test:
```bash
cd UserAPI_root_dir
phpunit
```
