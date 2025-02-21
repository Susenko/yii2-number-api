build:
	docker-compose up --build -d
	docker exec -it yii2-app composer install

start:
	docker-compose up -d

stop:
	docker-compose down

logs:
	docker-compose logs -f
