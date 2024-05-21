<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function () {
        if (version_compare(TYPO3_branch, '10.0', '>=')) {
            $moduleClass = \Skynettechnologies\Typo3Allinoneaccessibilitymonitor\Controller\ToolController::class;
        } else {
            $moduleClass = 'Tool';
        }
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Skynettechnologies.Typo3Allinoneaccessibilitymonitor',
            'Tool',
            [
                $moduleClass => 'list, update, create',
            ],
            // non-cacheable actions
            [
                $moduleClass => 'update, create',
            ]
        );

        $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);

        $iconRegistry->registerIcon(
            'typo3_allinoneaccessibilitymonitor-plugin-tool',
            \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            ['source' => 'EXT:typo3_allinoneaccessibilitymonitor/Resources/Public/Icons/user_plugin_aioapp.svg']
        );

        $iconRegistry->registerIcon(
            'module-typo3allinoneaccessibilitymonitor',
            \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            ['source' => 'EXT:typo3_allinoneaccessibilitymonitor/Resources/Public/Icons/module-sntg.svg']
        );
    }
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerTypeConverter('Skynettechnologies\\Typo3Allinoneaccessibilitymonitor\\Property\\TypeConverter\\UploadedFileReferenceConverter');
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerTypeConverter('Skynettechnologies\\Typo3Allinoneaccessibilitymonitor\\Property\\TypeConverter\\ObjectStorageConverter');
