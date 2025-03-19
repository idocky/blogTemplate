up:
	docker-compose up -d
stop:
	docker-compose stop
down:
	docker-compose down
to-workspace:
	docker exec -it peach_app /bin/bash
