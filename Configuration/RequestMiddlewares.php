<?php

return [
    'frontend' => [
        'Typo3Allinoneaccessibilitymonitor-frontend' => [
            'target' => \Skynettechnologies\Typo3Allinoneaccessibilitymonitor\Middleware\AwesomeMiddleware::class,
            'after' => [
                'typo3/cms-frontend/prepare-tsfe-rendering',
            ],
        ]
    ]
];
