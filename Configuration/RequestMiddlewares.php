<?php

return [
    'frontend' => [
        'Allinoneaccessibilitymonitor-frontend' => [
            'target' => \Skynettechnologies\Allinoneaccessibilitymonitor\Middleware\AwesomeMiddleware::class,
            'after' => [
                'typo3/cms-frontend/prepare-tsfe-rendering',
            ],
        ]
    ]
];
