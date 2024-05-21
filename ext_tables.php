<?php
// TYPO3 Security Check
defined('TYPO3_MODE') or die();

$_EXTKEY = $GLOBALS['_EXTKEY'] = 'typo3_allinoneaccessibilitymonitor';

//Add Modules
if (TYPO3_MODE === 'BE') {
    $isVersion9Up = \TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionNumberToInteger(TYPO3_version) >= 9000000;

    if (version_compare(TYPO3_branch, '8.0', '>=')) {

        // Add module 'skynettechnologies' after 'Web'
        if (!isset($GLOBALS['TBE_MODULES']['skynettechnologies'])) {
            $temp_TBE_MODULES = [];
            foreach ($GLOBALS['TBE_MODULES'] as $key => $val) {
                if ($key == 'web') {
                    $temp_TBE_MODULES[$key] = $val;
                    $temp_TBE_MODULES['skynettechnologies'] = '';
                } else {
                    $temp_TBE_MODULES[$key] = $val;
                }
            }
            $GLOBALS['TBE_MODULES'] = $temp_TBE_MODULES;
            $GLOBALS['TBE_MODULES']['_configuration']['skynettechnologies'] = [
                'iconIdentifier' => 'module-typo3allinoneaccessibilitymonitor',
                'labels' => 'LLL:EXT:typo3_allinoneaccessibilitymonitor/Resources/Private/Language/BackendModule.xlf',
                'name' => 'skynettechnologies',
            ];
        }

        if (version_compare(TYPO3_branch, '11.0', '>=')) {
            $moduleClass = \Skynettechnologies\Typo3Allinoneaccessibilitymonitor\Controller\ToolController::class;
        } else {
            $moduleClass = 'Tool';
        }
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
            'Skynettechnologies.Typo3Allinoneaccessibilitymonitor',
            'skynettechnologies', // Make module a submodule of 'skynettechnologies'
            'toolmodule', // Submodule key
            '', // Position
            [
                $moduleClass => 'accessibilityMonitorSettings',
            ],
            [
                'access' => 'user,group',
                'icon' => 'EXT:typo3_allinoneaccessibilitymonitor/Resources/Public/Icons/aio_app.svg',
                'labels' => 'LLL:EXT:typo3_allinoneaccessibilitymonitor/Resources/Private/Language/locallang_aioappmodule.xlf',
                'navigationComponentId' => ($isVersion9Up ? 'TYPO3/CMS/Backend/PageTree/PageTreeElement' : 'typo3-pagetree'),
                'inheritNavigationComponentFromMainModule' => false,
            ]
        );
    }
}
