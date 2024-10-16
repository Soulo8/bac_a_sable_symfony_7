sh:
	docker compose exec web zsh

php-cs-fixer:
	docker compose exec web ./vendor/bin/php-cs-fixer fix

phpstan:
	docker compose exec web ./vendor/bin/phpstan analyze

phpinsights:
	docker compose exec web ./vendor/bin/phpinsights

php-linters: php-cs-fixer phpstan
	docker compose exec web ./vendor/bin/phpinsights --no-interaction
	docker compose exec web ./bin/console lint:yaml config --parse-tags
	docker compose exec web ./bin/console lint:twig templates
	docker compose exec web ./bin/console lint:xliff translations
	docker compose exec web ./bin/console lint:container
	docker compose exec web ./bin/console doctrine:schema:validate --skip-sync -vvv --no-interaction
	docker compose exec web composer validate --strict

eslint:
	docker compose exec web npm run lint

js-build:
	docker compose exec web npm run build

test:
	docker compose exec web ./vendor/bin/phpunit

drop-test-db:
	docker compose exec web php bin/console --env=test --force doctrine:database:drop

create-test-db:
	docker compose exec web php bin/console --env=test doctrine:database:create
	docker compose exec web php bin/console --env=test doctrine:schema:create

composer-audit:
	docker compose exec web composer audit