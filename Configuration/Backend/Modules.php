<?php

return [
    'Sntg_module' => [
        'labels' => 'LLL:EXT:allinoneaccessibilitymonitor/Resources/Private/Language/BackendModule.xlf',
        'icon' => 'EXT:allinoneaccessibilitymonitor/Resources/Public/Icons/module-allinoneaccessibilitymonitor.svg',
        'iconIdentifier' => 'module-allinoneaccessibilitymonitor',
        'navigationComponent' => '@typo3/backend/page-tree/page-tree-element',
        'position' => ['after' => 'web'],
    ],
    'Sntg_AllinoneaccessibilitymonitorToolmodule' => [
        'parent' => 'Sntg_module',
        'position' => ['before' => 'top'],
        'access' => 'admin,user,group',
        'path' => '/module/Skynettechnologies/AllinoneaccessibilitymonitorToolmodule',
        'icon'   => 'EXT:allinoneaccessibilitymonitor/Resources/Public/Icons/aio_app.svg',
        'labels' => 'LLL:EXT:allinoneaccessibilitymonitor/Resources/Private/Language/locallang_aioappmodule.xlf',
        'navigationComponent' => '@typo3/backend/page-tree/page-tree-element',
        'extensionName' => 'Allinoneaccessibilitymonitor',
        'controllerActions' => [
            \Skynettechnologies\Allinoneaccessibilitymonitor\Controller\ToolController::class => [
                'accessibilityMonitorSettings',
            ],
        ],
    ],

];

?>
