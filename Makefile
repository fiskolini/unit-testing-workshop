run:
	docker-compose up -d php
install:
	docker-compose run php bash -c "composer install"
test:
	docker-compose run php bash -c "vendor/bin/phpunit -c phpunit.xml"
