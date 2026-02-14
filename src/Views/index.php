<?php

declare(strict_types=1);

use App\Utils\LayoutHelper;

LayoutHelper::assertRequestMethod('GET');
LayoutHelper::begin('Home', 'Welcome to the home page of our PHP site template.');
?>

<h2>What is This?</h2>
<p>
    This is a super simple PHP site template. It includes basic features like user
    authentication, a simple layout system, and a few example pages. It's designed to
    be a starting point for building your own PHP website.
</p>

<h2>
    Why not use
    <pre style="display: inline">&lt;insert popular PHP framework here&gt;</pre>?
</h2>
<p>
    <em>Honestly</em>, you probably should if you're building anything more than a
    simple website/blog. I just wanted something super minimal where I could be in
    completely control of the code and unleash my creativity without having to
    have a bloated framework getting in the way. Plus, it's a fun project to build and maintain!
</p>

<p>
    Like right now, I'm writing this text in a plain ass PHP file with raw HTML.
    No fancy templating engines, no complex frameworks, just pure PHP and HTML.
</p>

<p>
    I can even drop into some PHP right here and dump something cool on the page
</p>

<pre style="font-family: monospace;">
PHP <?= PHP_VERSION ?> | <?= PHP_SAPI ?>
<?= date('Y-m-d H:i:s') ?>
</pre>

<p>
    See that? My server put that there for you. It's beautiful.
</p>

<h2>That doesn't mean there are <em>NO</em> bells or whistles</h2>

<p>
    This baby comes equipped with some pretty fancy tech:
</p>

<ul>
    <li>PHP <?= PHP_VERSION ?></li>
    <li>
        JS/CSS bundler via <a href="https://esbuild.github.io/" target="_blank" rel="noopener noreferrer">esbuild</a>
        (with hot reloading)
    </li>
    <li>
        Code formatting/linting
        <ul>
            <li><a href="https://biomejs.dev/" target="_blank" rel="noopener noreferrer">BiomeJS</a> for JS/CSS/JSON</li>
            <li>
                <a href="https://laravel.com/docs/pint" target="_blank" rel="noopener noreferrer">Pint</a>,
                <a href="https://phpstan.org/" target="_blank" rel="noopener noreferrer">PHPStan</a>,
                and <a href="https://getrector.com" target="_blank" rel="noopener noreferrer">Rector</a> for PHP
            </li>
        </ul>
    </li>
    <li>
        Docker for easy development and deployment
        <ul>
            <li>Custom <a href="https://github.com/sorokya/php-site-template/blob/8caf537377927fd2899ff635cd1a14cc2d667973/docker/Dockerfile" target="_blank" rel="noopener noreferrer">Dockerfile</a> based on official PHP-FPM-Alpine image</li>
            <li><a href="https://github.com/sorokya/php-site-template/blob/8caf537377927fd2899ff635cd1a14cc2d667973/docker-compose.yml" target="_blank" rel="noopener noreferrer">docker-compose.yml</a> for local development</li>
            <li>Github Actions <a href="https://github.com/sorokya/php-site-template/blob/8caf537377927fd2899ff635cd1a14cc2d667973/.github/workflows/docker.yml" target="_blank" rel="noopener noreferrer">workflow</a> to build and push image to ghcr</li>
        </ul>
    </li>
</ul>

<h2>
    But at its core, it's just a simple PHP site template
</h2>

<p>
    No frameworks, no libraries, just pure PHP and HTML. It's a blank canvas for
    you to build whatever you want. A blog, a portfolio, a small business website,
    whatever. The possibilities are endless!
</p>

<?php LayoutHelper::end();
