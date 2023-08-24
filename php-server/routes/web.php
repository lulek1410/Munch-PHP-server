<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

Route::get('/resources/{file}', function ($file) {
    return response(file_get_contents(dirname(__DIR__) . "/resources/{$file}"), 200, ['Content-Type' => 'image/png']);
});

Route::get('/static/js/{file}', function ($file) {
    return response(file_get_contents(dirname(__DIR__) . "/resources/static/js/{$file}"), 200, ['Content-Type' => 'application/javascript']);
});

Route::get('/manifest.json', function ($file) {
    return response(file_get_contents(dirname(__DIR__) . '/resources/manifest.json'), 200, ['Content-Type' => 'application/json']);
});

Route::get('/static/css/{file}', function ($file) {
    return response(file_get_contents(dirname(__DIR__) . "/resources/static/css/{$file}"), 200, ['Content-Type' => 'text/css']);
});

Route::get('/static/media/{file}', function ($file) {
    $filePath = dirname(__DIR__) . "/resources/static/media/{$file}";

    if (!File::exists($filePath)) {
        abort(404);
    }

    $extension = pathinfo($filePath, PATHINFO_EXTENSION);

    if ($extension === 'webp') {
        $contentType = 'image/webp';
    } elseif ($extension === 'svg') {
        $contentType = 'image/svg+xml';
    } else {
        abort(400, 'Invalid file extension');
    }

    return response(file_get_contents($filePath), 200, ['Content-Type' => $contentType]);
});

Route::get('/{any?}', function () {
    return response(file_get_contents(dirname(__DIR__) . '/resources/index.html'), 200)
        ->header('Content-Type', 'text/html');
})->where('any', '^(menu(\/.*)?|order|people|news(\/.*)?|contact|admin(\/.*)?)$');
