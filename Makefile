PHP_SERVICE_NAME=php

.PHONY: start
start: ## Inicia el entorno de desarrollo
	docker-compose up -d

.PHONY: build
build: ## Inicia el entorno de desarrollo
	docker-compose up -d --build

.PHONY: stop
stop: ## Detiene el entorno de desarrollo
	docker-compose down

.PHONY: restart
restart: ## Reinicia el entorno de desarrollo
	docker-compose down
	docker-compose up -d

.PHONY: ssh-php
ssh-php: ## Accede al contenedor de PHP
	docker-compose exec $(PHP_SERVICE_NAME) bash

.PHONY: composer
composer: ## Ejecuta comandos de Composer, ej. make composer install
	docker-compose exec php composer $(filter-out $@,$(MAKECMDGOALS))

.PHONY: logs
logs: ## Muestra los logs de los contenedores
	docker-compose logs -f

.PHONY: test
test: ## Ejecuta pruebas PHPUnit
	docker-compose exec $(PHP_SERVICE_NAME) ./vendor/bin/phpunit

%:
	@: