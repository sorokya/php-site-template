<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

$url = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
if (!is_string($url)) {
    http_response_code(400);
    echo 'Bad Request';
    exit;
}

$urlSegments = array_values(array_filter(explode('/', $url)));

$viewsDir = __DIR__ . '/../src/Views';

$matchedFile = null;
$params = [];

$rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($viewsDir));

foreach ($rii as $file) {
    if (!$file instanceof SplFileInfo) {
        continue;
    }

    if (!$file->isFile()) {
        continue;
    }

    if ($file->getExtension() !== 'php') {
        continue;
    }

    $relativePath = ltrim(str_replace([$viewsDir, '.php'], '', $file->getPathname()), '/');
    $routeSegments = explode('.', $relativePath);

    // normalize "index" at root to empty segment
    if (count($routeSegments) === 1 && $routeSegments[0] === 'index') {
        $routeSegments = [];
    }

    $routeParams = [];

    if (matchRoute($routeSegments, $urlSegments, $routeParams)) {
        $matchedFile = $file->getPathname();
        $params = $routeParams;
        break;
    }
}

if ($matchedFile) {
    extract($params);
    include $matchedFile;
} else {
    http_response_code(404);
    echo 'Not Found';
}

/**
 * Matches a route pattern against the URL segments and extracts parameters.
 * Ignored case for static segments.
 * @param string[] $routeSegments
 * @param string[] $urlSegments
 * @param array<string, string> $params
 */
function matchRoute(array $routeSegments, array $urlSegments, array &$params): bool
{
    $params = [];

    if (count($routeSegments) !== count($urlSegments)) {
        return false;
    }

    foreach ($routeSegments as $i => $segment) {
        if (str_starts_with($segment, '$')) {
            $params[substr($segment, 1)] = $urlSegments[$i];
        } elseif (strcasecmp($segment, $urlSegments[$i]) !== 0) {
            return false;
        }
    }

    return true;
}
