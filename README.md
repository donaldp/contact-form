# Contact Form Application

## Requirements

* PHP 8 | PHP 7.4 will probably work
* Node.js `>= 14`
* Redis

## Getting Started

Clone repository:
```bash
git clone https://github.com/donaldp/contact-form.git
```

Install PHP dependencies:
```bash
composer install
```

Install Node dependencies:
```bash
npm i
```

Configure application:

```bash
cp .env.example .env
```

Set your database, redis and mail details in the `.env` file.

Cache configurations:
```bash
php artisan config:cache
``` 

Install the application:
```bash
php artisan app:install
```

> You will get login details

## Development (optional)

To compile Inertia/Vuejs run the following command:

```bash
npm run prod
```

## Redis

Listen to outgoing notification:

```bash
php artisan queue:listen
```

> If you don't have redis installed, change `QUEUE_CONNECTION` value from `redis` to `sync` in your `.env` file
