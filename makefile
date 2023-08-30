start:
	php artisan serve --host 0.0.0.0

setup:
	composer install
	cp -n .env.example .env|| true
	php artisan key:gen --ansi
	touch database/php_project_lvl4.sqlite
	php artisan migrate:fresh --force
	php artisan db:seed

log:
	tail -f storage/logs/laravel.log

test:
	php artisan test

test-coverage:
	composer exec --verbose phpunit tests -- --coverage-clover build/logs/clover.xml

deploy:
	git push heroku

lint:
	composer exec --verbose phpcs -- --standard=PSR12 app tests routes
