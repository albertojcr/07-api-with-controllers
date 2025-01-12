UID=$(shell id -u)
GID=$(shell id -g)
DOCKER_PHP_SERVICE=php-fpm

start: erase cache-folders build composer-install up

erase:
		docker-compose down -v

build:
		docker-compose build && \
		docker-compose pull

cache-folders:
		mkdir -p ~/.composer && chown ${UID}:${GID} ~/.composer

composer-install:
		docker-compose run --rm -u ${UID}:${GID} ${DOCKER_PHP_SERVICE} composer install

up:
		docker-compose up -d

stop:
		docker-compose stop

down: ## alias stop
		make stop

bash:
		docker-compose run --rm ${DOCKER_PHP_SERVICE} bash

logs:
		docker-compose logs -f ${DOCKER_PHP_SERVICE}