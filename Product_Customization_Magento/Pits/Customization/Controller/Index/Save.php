<?php

namespace Pits\Customization\Controller\Index;
 
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Pits\Customization\Model\FormFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;
use Magento\Customer\Model\Session;
 
class Save extends Action
{
    protected $resultPageFactory;
    protected $formFactory;
    protected $_formFactory;
    private static $_siteVerifyUrl = "https://www.google.com/recaptcha/api/siteverify?";
    private $_secret;
    protected $customerSession;
    protected $userContext;
    private static $_version = "php_1.0";
 
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        FormFactory $formFactory,
        Session $customerSession,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->formFactory = $formFactory;
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        $this->customerSession = $customerSession;
        parent::__construct($context);
    }
    public function execute()
        {
            $captcha = $this->getRequest()->getParam('g-recaptcha-response');
            $secret = $this->getSecretValueRecaptcha(); //Replace with your secret key
            $response = null;
            $path = self::$_siteVerifyUrl;
            $dataC = array (
            'secret' => $secret,
            'remoteip' => $_SERVER["REMOTE_ADDR"],
            'v' => self::$_version,
            'response' => $captcha
            );
            $req = "";
            foreach ($dataC as $key => $value) {
             $req .= $key . '=' . urlencode(stripslashes($value)) . '&';
            }
            // Cut the last '&'
            $req = substr($req, 0, strlen($req)-1);
            $response = file_get_contents($path . $req);
            $answers = json_decode($response, true);
            if(trim($answers ['success']) == true) {
                try {
                    $data = (array)$this->getRequest()->getPost();
                    if ($data) {
                        $model = $this->formFactory->create()->setData($data);
                        $model
                                ->setCustomerId($this->customerSession->getCustomerId())
                                ->setStoreId($this->storeManager->getStore()->getId())
                                ->save();
                        $this->messageManager->addSuccessMessage(__("Request Sent Successfully."));
                    }
                } catch (\Exception $e) {
                    $this->messageManager->addErrorMessage(__("We can\'t submit your request, Please try again."));
                }
                
            }
            else{
                $this->messageManager->addErrorMessage( __("Invalid captche, Try again"));
            }
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl($this->_redirect->getRefererUrl());
            return $resultRedirect;
        }

    public function getSecretValueRecaptcha() 
    {
        return $this->scopeConfig->getValue("recaptcha_frontend/type_recaptcha/private_key",
        \Magento\Store\Model\ScopeInterface::SCOPE_STORE,$this->storeManager->getStore()->getStoreId());
    }
}