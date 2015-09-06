# php-soa
### Prequisites
* Composer https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx
* local PHP install (for Development only, if not using Docker).
* Linux or OSX operating system for development (Windows untested)

## Installation of required vendor packages
From a terminal:
``
composer install
``

## Run Local Development server
From a terminal:
``
composer serve
``


Then browse to http://localhost:300/api/example for an example endpoint. These are specified in `service_api.php`.

Your code goes in the `Service_Example` class and should output JSON via the `self::out()` function.

The `bootstrap.php` is where your routes are configured.

# Docker deploy
## Prerequisites
* Docker http://docker.com

Before deploying via Docker, rename the container from `php-soa-example` in `docker_build.sh` to something more relevant.

To build:

``./docker_build.sh``
