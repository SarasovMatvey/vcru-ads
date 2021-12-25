format-psr12:
	vendor/bin/phpcbf --standard=PSR12 src

check-psr12:
	vendor/bin/phpcs --standard=PSR12 src

static-check:
	vendor/bin/phpstan analyse src -l 9

migrations-diff:
	vendor/bin/doctrine-migrations migrations:diff

migrations-migrate:
	vendor/bin/doctrine-migrations migrations:migrate