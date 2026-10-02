<?php

/** @var string $_EXTKEY */
$EM_CONF[$_EXTKEY] = [
    'title' => 'Language labels as JSON',
    'description' => 'Connector between ext:t3api and ext:translatr which allows to get language labels as JSON.',
    'category' => 'module',
    'author' => '',
    'author_email' => '',
    'state' => 'stable',
    'version' => '4.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '13.4.0-14.4.99',
            'translatr' => '7.0.0-7.99.999',
            't3api' => '4.0.0-5.99.999',
        ],
        'conflicts' => [
        ],
        'suggests' => [
        ],
    ],
];
