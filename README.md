# Laravel Interview Starter

A backend-focused Laravel 12 starter for a PHP 8.3+ HTTP API backed by MySQL. It is intentionally a small skeleton, not a prebuilt solution to an interview exercise.

## Requirements

- Docker Desktop with Docker Compose
- Git
- VS Code (recommended)

PHP and Composer run inside the PHP-FPM container; they do not need to be installed on the host.

## Run the Docker services

```sh
cp .env.example .env
docker compose run --rm app composer install
docker compose run --rm app php artisan key:generate
docker compose up --build -d
docker compose exec app php artisan migrate
```

This starts Nginx, PHP-FPM, and MySQL. Keep the services running while developing; add `-d` to `docker compose up --build` to run them in the background. The API is available at <http://localhost:8080/api/health>. `GET /up` is Laravel's framework health endpoint.

## API documentation

Open <http://localhost:8080/api-docs/> while the Docker services are running to browse the API in Swagger UI. The OpenAPI 3.0 specification is available at <http://localhost:8080/openapi.yaml> and is maintained in [`public/openapi.yaml`](./public/openapi.yaml). Swagger UI assets load from the unpkg CDN, so the browser needs internet access to render the interactive page.

Stop the services with `docker compose down`. MySQL data is kept in a named volume when services stop.

## Tests and code style

Feature tests use Laravel's HTTP testing tools. The test environment is configured for the MySQL service used by Compose and GitHub Actions, so database-backed feature tests can share that setup.

```sh
docker compose exec app composer test
docker compose exec app composer test:unit
docker compose exec app composer test:feature
docker compose exec app composer lint
docker compose exec app composer analyse
```

`tests/Unit` and `tests/Feature` are separate PHPUnit suites. The feature suite includes an HTTP test for the example health route. `composer lint` checks PHP files against PSR-12 with PHP_CodeSniffer, and `composer analyse` runs PHPStan with Larastan at level 5. Add behavior-focused tests before implementation, then run the narrowest relevant suite and the full suite before finishing.

## Execute API requests

Install the recommended extensions from `.vscode/extensions.json`, including REST Client and PHP Sniffer. PHP Sniffer reports PSR-12 diagnostics in the editor and can use the project-local `vendor/bin/phpcs`. Start the Docker services, open [`requests/api.http`](./requests/api.http) in VS Code, and use **Send Request** above a request to call the local API. The file includes both the example API endpoint and Laravel's framework health endpoint.

## GitHub

The repository includes a GitHub Actions workflow that builds and runs this project's Docker Compose services, then runs Composer, migrations, dependency auditing, PSR-12, PHPStan, and the PHPUnit suites with coverage thresholds inside the PHP container. It uses the checked-in Dockerfiles and Compose configuration; the images are built on the GitHub runner and do not need to be published to a registry. Clover and HTML coverage reports are uploaded as the `php-coverage` workflow artifact. To view them, open a completed workflow run, download the `php-coverage` artifact, unzip it, then open `unit-html/index.html` or `functional-html/index.html` in a browser. To publish this folder, create an empty GitHub repository and add it as the `origin` remote before pushing.
