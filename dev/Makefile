setup: up composer ## Setup the project

composer: ## Run composer install
	docker-compose exec -T php_cli composer install

cli: ## CLI into PHP container
	docker-compose exec php_cli ash

up: ## Start project
	docker-compose up -d --remove-orphans

stop: ## Stop project
	docker-compose stop