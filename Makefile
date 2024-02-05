up:
	docker compose up -d

up-build:
	docker compose up -d --build

down:
	docker compose down

up-db:
	docker compose up -d mysql

logs:
	docker compose logs -f
