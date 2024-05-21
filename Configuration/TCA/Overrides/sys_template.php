<?php
defined('TYPO3_MODE') or die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('typo3_allinoneaccessibilitymonitor', 'Configuration/TypoScript', '[NITSAN] Tool');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_typo3allinoneaccessibilitymonitor_domain_model_tool', 'EXT:typo3_allinoneaccessibilitymonitor/Resources/Private/Language/locallang_csh_tx_typo3allinoneaccessibilitymonitor_domain_model_aioapp.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_typo3allinoneaccessibilitymonitor_domain_model_tool');
