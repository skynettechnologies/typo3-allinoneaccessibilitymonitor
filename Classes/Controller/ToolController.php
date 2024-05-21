<?php
namespace Skynettechnologies\Allinoneaccessibilitymonitor\Controller;

use Skynettechnologies\Allinoneaccessibilitymonitor\AdaConstantModule\TypoScriptTemplateConstantEditorModuleFunctionController;
use Skynettechnologies\Allinoneaccessibilitymonitor\Property\TypeConverter\UploadedFileReferenceConverter;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Property\PropertyMappingConfiguration;
use TYPO3\CMS\Tstemplate\Controller\TypoScriptTemplateModuleController;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Core\Environment;

/***
 *
 * This file is part of the "All in One AccessibilityMonitor" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020
 *
 ***/

/**
 * ToolController
 */
class ToolController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * toolstyleRepository
     *
     * @var \Skynettechnologies\Allinoneaccessibilitymonitor\Domain\Repository\ToolRepository
     */
    protected $toolstyleRepository = null;

    public function __construct(
        \Skynettechnologies\Allinoneaccessibilitymonitor\Domain\Repository\ToolstyleRepository $toolstyleRepository
    ) {
        $this->toolstyleRepository = $toolstyleRepository;
    }

    protected $constantObj;

    protected $constants;

    /**
     * @var TypoScriptTemplateModuleController
     */
    protected $pObj;

    protected $contentObject = null;

    protected $pid = null;

    /**
     * Initializes this object
     *
     * @return void
     */
    public function initializeObject()
    {
        $this->contentObject = GeneralUtility::makeInstance('TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer');
        $this->constantObj = GeneralUtility::makeInstance(TypoScriptTemplateConstantEditorModuleFunctionController::class);
    }

    /**
     * Initialize Action
     *
     * @return void
     */
    public function initializeAction()
    {

        //GET CONSTANTs
        $this->constantObj->init($this->pObj);
        $this->constants = $this->constantObj->main();
    }

    /**
     * action list
     *
     * @return ResponseInterface
     */
    public function mainAction(): ResponseInterface
    {
        return $this->htmlResponse();
    }

    /**
     * action accessibilityMonitorSettingsAction
     *
     * @return ResponseInterface
     */
    public function accessibilityMonitorSettingsAction(): ResponseInterface
    {

        $this->view->assign('action', 'accessibilityMonitorSettings');
        $this->view->assign('constant', $this->constants);

        $host = GeneralUtility::locationHeaderUrl( '/' );
       $domain = parse_url($host, PHP_URL_HOST);

        $curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://ada.skynettechnologies.us/api/check-scanner-website',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => array('domain' =>  $domain),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		$settingURLObject = json_decode($response);

        $this->view->assign('accscan_status', $settingURLObject->status);
        $this->view->assign('accscan_website_domain', $domain);
        $this->view->assign('settinglink', $settingURLObject->settinglink);
        $this->view->assign('manage_domain', $settingURLObject->manage_domain);

        return $this->htmlResponse();
    }
}
