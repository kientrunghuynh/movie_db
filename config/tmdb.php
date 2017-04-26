<?php
/**
 * Created by PhpStorm.
 * User: trung.huynh
 * Date: 4/26/17
 * Time: 1:31 PM
 */
return [
    /*
     * Api key
     */
    'api_key' => env('TMDB_API_KEY_V3'),
    /**
     * Client options
     */
    'options' => [
        /**
         * Use https
         */
        'secure' => true,
        /*
         * Cache
         */
        'cache' => [
            'enabled' => true,
            // Keep the path empty or remove it entirely to default to storage/tmdb
            'path' => storage_path('tmdb')
        ],
        /*
         * Log
         */
        'log' => [
            'enabled' => true,
            // Keep the path empty or remove it entirely to default to storage/logs/tmdb.log
            'path' => storage_path('logs/tmdb.log')
        ]
    ],
];