# PHP Site Template

 A minimal PHP site starter with file-based routing, layout support, and a modern asset pipeline.

 ## Features

 - File-based routing from `src/Views`
 - Simple layout system with a base layout
 - Asset bundling with esbuild (CSS + JS)
 - Docker dev stack with PHP-FPM, Nginx, and MariaDB
 - Code quality tools: Pint, PHPStan, Rector, Biome

 ## Requirements

 Choose one of the following setups:

 - Docker: Docker Desktop (recommended)
 - Local: PHP, Composer, Node.js, pnpm

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

 ## Routing

 Routes are derived from files in `src/Views`.

 - `src/Views/index.php` -> `/`
 - `src/Views/foo.php` -> `/foo`
 - `src/Views/blog.posts.php` -> `/blog/posts`
 - `src/Views/blog.$slug.php` -> `/blog/{slug}`
 - `src/Views/blog.posts.$id.php` -> `/blog/posts/{id}`

 Dynamic segments start with `$` and are passed into the view via extracted variables.

 ## Layouts

 The base layout lives at `src/Views/Layouts/base.php` and expects `$viewContent`.
 Each view can set `$viewTitle` and `$viewDescription` to customize metadata.

 ## Assets

 Source files:

 - `css/global.css`
 - `js/global.js`

 Build output:

 - `public/css/global.css`
 - `public/js/global.js`

 Commands:

 ```bash
 pnpm run build
 pnpm run dev
 pnpm run format
 ```

 ## PHP Tooling

 ```bash
 composer run pint
 composer run pint:check
 composer run phpstan
 composer run rector
 composer run rector:check
 composer run check
 composer run fix
 ```

 ## Tests

 ```bash
 ./vendor/bin/pest
 ```

 ## Project Structure

 - `public/` web root and front controller
 - `src/Views/` route-mapped templates
 - `css/` and `js/` asset sources
 - `docker/` container configs

 ## License

 MIT
