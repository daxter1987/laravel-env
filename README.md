# daxter1987/laravel-env

By installing this composer package into your laravel application, this enables the ``php artisan dax:install`` command, which creates a docker-compose.yml and a daxenv.sh file into your laravel root directory. Then you can run ``docker compose up -d`` and you have a laravel environment with a database.

## Requirements

1. Must have docker installed
1. Must have docker-compose installed

## Installation

#### 1. Install using composer by running:

```
composer require daxter1987/laravel-env
```

#### 2. Once installed run the command

```
php artisan dax:install
```

This creates 2 files:

1. docker-compose.yml: compose file with 2 containers
    1. Ubuntu image with nginx and Php 7.3
    1. Database image
1. daxenv.sh: file with useful shortcuts to run your environment

This also checks the .gitignore in your laravel project and adds the line ``/db`` if it doesn't exist. This is the folder where docker will store your local database container volume.

#### 3. [Optional but recommended] Give the daxenv.sh execute permissions

If you want to use the shortcuts give the daxenv.sh file executing permissions by running the command:

```
sudo chmod 777 daxenv.sh
```

#### 4. Configure database

The database connection credentials can be found in your newly created ``docker-compose.yml`` file. Make sure the database connection is properly configured either in your ``.env`` file or your ``config/database.php`` file.

```
MYSQL_ROOT_PASSWORD: root
MYSQL_DATABASE: db
MYSQL_USER: root
MYSQL_PASSWORD: root
```

## Usage

### With shortcuts

To start the environment run

```
./daxenv.sh up
```

To stop the environment

```
./daxenv.sh down
```

To ssh into the laravel container

```
./daxenv.sh ssh
```

### Without shortcuts

To start the environment run

```
docker-compose up -d
```

To stop the environment

```
docker-compose down
```

To ssh into the laravel container run ``docker container ls`` to get the name of the container, then replace the container name for CONTAINER_NAME in the command below

```
docker exec -it CONTAINER_NAME ssh
```
