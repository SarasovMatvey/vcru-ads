format-psr12:
	vendor/bin/phpcbf --standard=PSR12 src

check-psr12:
	vendor/bin/phpcs --standard=PSR12 src

static-check:
	vendor/bin/phpstan analyse src