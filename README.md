# Installation Guide
## System Requirements laravel 7
- PHP version: ^7.2
- Apache version: >=2.4.27
- Composer version: >=1

## Create Env
```
cp .env.example .env
```

## Docker Up container
```
docker-compose up -d
```

## Install Vendor
```
docker-compose exec learn-docker-dev bash -c "composer install"
```

## Generate Key App
```
docker-compose exec learn-docker-dev bash -c "php artisan key:generate"
```

## Npm Install
```
docker-compose exec learn-docker-dev bash -c "npm install"
```

## Npm Build
```
docker-compose exec learn-docker-dev bash -c "npm run dev"
```

## Set DB Setting
Changes your DB environment to your database settings on `.env` file
```
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

## Run DB Migration
Skip this step if you already have migration
```
docker-compose exec learn-docker-dev bash -c "php artisan migrate"
```

## Test
go to your localhost url
```
http://<app_url>
```
