[![GitHub Actions Workflow Status](https://img.shields.io/github/actions/workflow/status/sorokya/php-site-template/tests.yml?style=plastic)](https://github.com/sorokya/php-site-template/actions/workflows/tests.yml)

# PHP Site Template

 A minimal and opinionated PHP site starter with file-based routing, layout support, and a modern asset pipeline.

 ## Features

 - File-based routing from `src/Pages`
 - Simple layout system with a base layout
 - Asset bundling with esbuild (CSS + JS)
  - With hot reloading in development
 - Docker dev stack with PHP-FPM, Nginx, and MariaDB
 - Code quality tools: Pint, PHPStan, Rector, Biome
 - Example blog site with authentication and database integration
 - Database migrations and seeding with Phinx
   - Migrations are automatially run on container startup (see `docker/entrypoint.sh`)

 ## Requirements

 Choose one of the following setups:

 - Docker: Docker Desktop (recommended)
 - Local: PHP, Composer, Node.js, pnpm

 Copy the example environment file:

 ```bash
 cp .env.example .env
 ```

 ## Quick Start (Docker)

 1. Build and start the stack:

	 ```bash
	 docker compose up --build
	 ```

 2. Open http://localhost:8000

 MariaDB is available at `localhost:3306` with:

 - database: `website`
 - user: `website`
 - password: `website`
 - root password: `root`

 ## Local Development

 1. Install PHP dependencies:

	 ```bash
	 composer install
	 ```

 2. Install JS dependencies:

	 ```bash
	 pnpm install
	 ```

 3. Start the asset watcher:

	 ```bash
	 pnpm run dev
	 ```

 4. Run the PHP server:

	 ```bash
	 php -S localhost:8000 -t public public/index.php
	 ```

 Then open http://localhost:8000

 ## Database Migrations and Seeding

 Migrations are defined in `db/migrations` and seeds are defined in `db/seeds`. The Phinx configuration is in `phinx.php`.

 To create a new migration:
```bash
composer phinx create MyNewMigration
```

To run migrations:
```bash
composer phinx migrate
```

See the [Phinx documentation](https://book.cakephp.org/phinx/0/en/index.html) for more details on defining migrations and seeds.

 ## Routing

 Routes are derived from files in `src/Pages`.

 - `src/Pages/index.php` -> `/`
 - `src/Pages/login.php` -> `/login`
 - `src/Pages/blog.posts.php` -> `/blog/posts`
 - `src/Pages/blog.posts.$slug.php` -> `/blog/posts/{slug}`

 Dynamic segments start with `$` and are passed into the view via extracted variables.

 ## Layouts

 An example layout is defined in `src/Layouts/base.php`. Pages can use a layout by using the `LayoutHelper::begin` and `LayoutHelper::end` methods:

 ```php
 <?php

 declare(strict_types=1);

 use App\Utils\LayoutHelper;

 LayoutHelper::assertRequestMethod('GET');
 LayoutHelper::begin('Home', 'Welcome to the home page of our PHP site template.');
 ?>

 <h1>Hello from index!</h1>

 <?php LayoutHelper::end();
 ```

 The `LayoutHelper::assertRequestMethod` method can be used to restrict routes to specific HTTP methods. In this example, the route will only match GET requests. If a different method is used, a 405 Method Not Allowed response will be returned.

 ## CSS and JS Assets

 Source files:

 - `css/global.css`
 - `js/global.js`

 Build output:

 - `public/css/global.css`
 - `public/js/global.js`

 Commands:

 ```bash
 # Build assets once
 pnpm run build

 # Start watcher with hot reload
 pnpm run dev
 ```

 ## PHP Tooling

 ```bash
 # Run pint, phpstan, and rector to check code quality
 composer run check

 # automatically fix issues with pint and rector
 composer run fix
 ```

 ## Tests

 Tests are defined in the `tests/` directory and use pest as the testing framework.

 To run tests:

 ```bash
 composer test
 ```

 ## Project Structure

 - `public/` web root and front controller
 - `src/Pages/` route-mapped controllers/pages
 - `src/Layouts/` reusable layout templates
 - `src/Utils/` helper classes (e.g. LayoutHelper)
 - `src/Authentication/` authentication logic, user, and session management
 - `src/Data/PDO.php` simple PDO wrapper for database interactions
 - `css/` and `js/` asset sources
 - `docker/` container configs, scripts, and Dockerfile
 - `db/{migrations,seeds}/` database migrations and seeds
 - `tests/` php pest tests
 - `phinx.php` database migration config
 - `docker-compose.yml` Docker Compose config for local development
 - `.env.example` example environment variables
 - `build.mjs` esbuild config for asset bundling

 ## License

 MIT
