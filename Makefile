up:
	docker compose up -d

gen-openapi:
	docker compose exec app sh -c "./LaravelTodo/vendor/bin/openapi ./LaravelTodo/app -o /output/openapi.yaml"
