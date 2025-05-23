<?php
/** @var string $_EXTKEY */
$EM_CONF[$_EXTKEY] = [
    'title' => 'Language labels as JSON',
    'description' => 'Connector between ext:t3api and ext:translatr which allows to get language labels as JSON.',
    'category' => 'module',
    'author' => '',
    'author_email' => '',
    'state' => 'stable',
    'internal' => '',
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '3.2.0',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5.0-13.4.999',
            'translatr' => '4.0.0-7.99.999',
            't3api' => '1.0.0-4.99.999'
        ],
        'conflicts' => [
        ],
        'suggests' => [
        ],
    ],
];
