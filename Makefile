.PHONY: up down phpcs phpstan

# Cible pour démarrer les services en arrière-plan
up:
	docker-compose up -d

# Cible pour arrêter et supprimer les services
down:
	docker-compose down

# Cible pour lancer PHP_CodeSniffer
phpcs:
	vendor/bin/phpcs

# Cible pour lancer PHPStan
phpstan:
	vendor/bin/phpstan
