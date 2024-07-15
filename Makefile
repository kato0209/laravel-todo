up:
	docker compose up -d

gen-openapi:
	docker compose exec app sh -c "./LaravelTodo/vendor/bin/openapi ./LaravelTodo/app -o /output/openapi.yaml"

migrate:
	docker compose exec app sh -c "cd LaravelTodo && php artisan migrate"

TEMPLATE?=
create_migration_file:
	docker compose exec app sh -c "cd LaravelTodo && php artisan make:migration create_${TEMPLATE}_table"

add_contoroller:
	docker compose exec app sh -c "cd LaravelTodo && php artisan make:controller ${TEMPLATE}Controller"
