<?php
namespace Skynettechnologies\Typo3Allinoneaccessibilitymonitor\Controller;

use Skynettechnologies\Typo3Allinoneaccessibilitymonitor\AdaConstantModule\TypoScriptTemplateConstantEditorModuleFunctionController;
use Skynettechnologies\Typo3Allinoneaccessibilitymonitor\Property\TypeConverter\UploadedFileReferenceConverter;
use TYPO3\CMS\Core\TypoScript\ExtendedTemplateService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Annotation\Inject as inject;
use TYPO3\CMS\Extbase\Property\PropertyMappingConfiguration;
use TYPO3\CMS\Tstemplate\Controller\TypoScriptTemplateModuleController;
use TYPO3\CMS\Core\Core\Environment;
/***
 *
 * This file is part of the "All in One Accessibility Monitor" Extension for TYPO3 CMS.
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
     * ToolRepository
     *
     * @var \Skynettechnologies\Typo3Allinoneaccessibilitymonitor\Domain\Repository\ToolRepository
     * @inject
     */
    protected $ToolRepository = null;

    /**
     * @param \Skynettechnologies\Typo3Allinoneaccessibilitymonitor\Domain\Repository\ToolstyleRepository $ToolstyleRepository
     */
    public function injectToolstyleRepository(\Skynettechnologies\Typo3Allinoneaccessibilitymonitor\Domain\Repository\ToolstyleRepository $toolstyleRepository)
    {
        $this->toolstyleRepository = $toolstyleRepository;
    }

    protected $templateService;

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
        $this->templateService = GeneralUtility::makeInstance(ExtendedTemplateService::class);
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
     * @return void
     */
    public function accessibilityMonitorSettingsAction()
    {
        $this->view->assign('action', 'widgetSet tings');
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
