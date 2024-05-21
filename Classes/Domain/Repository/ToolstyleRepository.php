<?php
namespace Skynettechnologies\Allinoneaccessibilitymonitor\Domain\Repository;

/***
 *
 * This file is part of the "Allinoneaccessibilitymonitor" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2021
 *
 ***/
/**
 * The repository for Toolstyles
 */
class ToolstyleRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * Initializes the repository
     */
    public function initializeObject()
    {
        $querySettings = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings::class);
        $querySettings->setRespectStoragePage(false);
        $this->setDefaultQuerySettings($querySettings);
    }

    public function findAllstyle()
    {
        $query = $this->createQuery();

        $query->getQuerySettings()->setRespectStoragePage(false);
        $query->getQuerySettings()->setRespectSysLanguage(false);
        return $this->createQuery()->execute();
    }
}
