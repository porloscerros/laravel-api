
## Technologies

PHP  8.2  
MySQL 8.0  
[Laravel 10.x](https://laravel.com/docs/10.x)  

---

## Local environment


### Dependencies

- [Docker](https://www.docker.com)
- [Docker Compose](https://docs.docker.com/compose/install/)


### Before starting

Clone the repository:
```
git clone git@github.com:porloscerros/laravel-api.git
cd laravel-api
```

An unversioned file is needed for Laravel works.  
To generate it take by reference `.env.example`
```
cp .env.example .env
```

Install packages required by Laravel via composer:
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
``` 

Configure a shell alias that allows you to execute Sail's commands more easily:
```
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```
To make sure this is always available, you may add this to your shell configuration file in your home directory, such as `~/.zshrc` or `~/.bashrc`, and then restart your shell.


### Start up docker containers

```
sail up
```

Generate hash for the web application `APP_KEY=` with the following command:
```
sail artisan key:generate
```

Run migrations and seeders:
```
sail artisan migrate --seed
```
That will create the tables in the Database and insert the users to log into the application.


### Access

You can now access the application via [http://localhost](http://localhost).


### Utils

#### PHPmyadmin
We have a container with phpmyadmin running on:  
[http://localhost:8081](http://localhost:8081)

    - *server*: mysql
    - *user*: root
    - *pass*: password // or .env DB_PASSWORD

#### Logs
Laravel generates its own log file on `storage/logs/laravel.log`
To see it in real time on the console, open a terminal and run:
```
tail -f storage/logs/laravel.log
```


---

## Unversioned files
- `src/.env`
