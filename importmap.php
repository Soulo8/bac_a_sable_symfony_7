<?php

/**
 * Returns the importmap for this application.
 *
 * - "path" is a path inside the asset mapper system. Use the
 *     "debug:asset-map" command to see the full list of paths.
 *
 * - "entrypoint" (JavaScript only) set to true for any module that will
 *     be used as an "entrypoint" (and passed to the importmap() Twig function).
 *
 * The "importmap:require" command can be used to add new entries to this file.
 */
return [
    'app' => [
        'path' => './assets/app.js',
        'entrypoint' => true,
    ],
    '@hotwired/stimulus' => [
        'version' => '3.2.2',
    ],
    '@symfony/stimulus-bundle' => [
        'path' => './vendor/symfony/stimulus-bundle/assets/dist/loader.js',
    ],
    '@hotwired/turbo' => [
        'version' => '7.3.0',
    ],
    'react' => [
        'version' => '18.3.1',
    ],
    'react-dom' => [
        'version' => '18.3.1',
    ],
    'scheduler' => [
        'version' => '0.23.2',
    ],
    '@symfony/ux-react' => [
        'path' => './vendor/symfony/ux-react/assets/dist/loader.js',
    ],
    'react-sortablejs' => [
        'version' => '6.1.4',
    ],
    'sortablejs' => [
        'version' => '1.15.3',
    ],
    'classnames' => [
        'version' => '2.3.1',
    ],
    'tiny-invariant' => [
        'version' => '1.2.0',
    ],
    'flowbite' => [
        'version' => '2.5.2',
    ],
    '@popperjs/core' => [
        'version' => '2.11.8',
    ],
    'flowbite-datepicker' => [
        'version' => '1.3.0',
    ],
    'flowbite/dist/flowbite.min.css' => [
        'version' => '2.5.2',
        'type' => 'css',
    ],
    'tom-select' => [
        'version' => '2.3.1',
    ],
    'tom-select/dist/css/tom-select.default.css' => [
        'version' => '2.3.1',
        'type' => 'css',
    ],
    'filepond' => [
        'version' => '4.31.4',
    ],
    'filepond-plugin-image-preview' => [
        'version' => '4.6.12',
    ],
    'filepond-plugin-file-validate-size' => [
        'version' => '2.2.8',
    ],
    'filepond-plugin-file-validate-type' => [
        'version' => '1.2.9',
    ],
    'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css' => [
        'version' => '4.6.12',
        'type' => 'css',
    ],
    'filepond/dist/filepond.css' => [
        'version' => '4.31.4',
        'type' => 'css',
    ],
    'filepond-plugin-file-encode' => [
        'version' => '2.1.14',
    ],
    'filepond-plugin-file-poster' => [
        'version' => '2.5.1',
    ],
    'filepond-plugin-file-poster/dist/filepond-plugin-file-poster.css' => [
        'version' => '2.5.1',
        'type' => 'css',
    ],
    'filepond/locale/fr-fr.js' => [
        'version' => '4.31.4',
    ],
];
