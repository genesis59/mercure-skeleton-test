.PHONY: up down phpcs phpstan phpcbf migration migrate seed

# Cible pour démarrer les services en arrière-plan
up: vendor/autoload.php
	docker-compose up -d

# Cible pour arrêter et supprimer les services
down:
	docker-compose down

# Cible pour lancer PHP_CodeSniffer
phpcs: vendor/autoload.php
	vendor/bin/phpcs

phpcbf: vendor/autoload.php
	vendor/bin/phpcbf

# Cible pour lancer PHPStan
phpstan: vendor/autoload.php
	vendor/bin/phpstan

migration: vendor/autoload.php
	docker-compose exec php bin/console make:migration

migrate: vendor/autoload.php
	docker-compose exec php bin/console doctrine:migrations:migrate

seed: vendor/autoload.php
	docker-compose exec php bin/console doctrine:fixtures:load

vendor/autoload.php: composer.lock
	composer install
	touch vendor/autoload.php
