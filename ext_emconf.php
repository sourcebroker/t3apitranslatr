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
    'uploadfolder' => '0',
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '2.5.0',
    'constraints' => [
        'depends' => [
            'typo3' => '9.5.0-11.5.999',
            'translatr' => '1.0.0-5.99.999',
            't3api' => '0.5.0-2.99.999'
        ],
        'conflicts' => [
        ],
        'suggests' => [
        ],
    ],
];
