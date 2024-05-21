<?php
defined('TYPO3') || die('Access denied.');

call_user_func(
    function () {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Allinoneaccessibilitymonitor',
            'Tool',
            [
                \Skynettechnologies\Allinoneaccessibilitymonitor\Controller\ToolController::class => 'main',
            ],
            // non-cacheable actions
            [
                \Skynettechnologies\Allinoneaccessibilitymonitor\Controller\ToolController::class => 'main',
            ]
        );

        $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);

        $iconRegistry->registerIcon(
            'scanner-plugin-tool',
            \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            ['source' => 'EXT:allinoneaccessibilitymonitor/Resources/Public/Icons/user_plugin_aioapp.svg']
        );

        $iconRegistry->registerIcon(
            'module-Allinoneaccessibilitymonitor',
            \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            ['source' => 'EXT:allinoneaccessibilitymonitor/Resources/Public/Icons/module-sntg.svg']
        );

        $GLOBALS['TYPO3_CONF_VARS']['SYS']['features']['security.backend.enforceContentSecurityPolicy'] = false;
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['features']['security.frontend.enforceContentSecurityPolicy'] = false;
    }
);
