<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Pits\Customization\Block\Product;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\View\Element\Template;
use Pits\Customization\Model\ResourceModel\Form\Collection;
use \Magento\Customer\Model\SessionFactory;




/**
 * Product Customization Tab
 *
 * @api
 * @author     Magento Core Team <core@magentocommerce.com>
 * @since 100.0.2
 */
class Custom extends Template implements IdentityInterface
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;
    protected $customer; 
    public $collection;
    protected $sessionFactory;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Pits\Customization\Model\ResourceModel\Form\CollectionFactory $collectionFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Pits\Customization\Model\ResourceModel\Form\CollectionFactory $collectionFactory,
        \Magento\Framework\App\Http\Context $httpContext,
        \Magento\Framework\UrlInterface $urlModel,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Customer\Model\Customer $customer,
        Collection $collection,
        SessionFactory $sessionFactory,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        $this->_reviewsColFactory = $collectionFactory;
        $this->httpContext = $httpContext;
        $this->_urlModel = $urlModel;
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        $this->sessionFactory = $sessionFactory;
        $this->customer = $customer;
        $this->collection = $collection;
        parent::__construct($context, $data);

        $this->setTabTitle();
    }

    /**
     * Get current product id
     *
     * @return null|int
     */
    public function getProductId()
    {
        $product = $this->_coreRegistry->registry('product');
        return $product ? $product->getId() : null;
    }

    /**
     * Return unique ID(s) for each object in system
     *
     * @return array
     */
    public function getIdentities()
    {
        return ['customization_block'];
    }
    /**
     * Set tab title
     *
     * @return void
     */
    public function setTabTitle()
    {
        $this->setTitle($this->getConfigValueTabTitle());
    }
    public function isCustomerLoggedIn()
    {
        return (bool)$this->httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
    }

    public function getLoginandRedirectpage()
    {
        $url = $this->_urlModel->getCurrentUrl();
        $login_url = $this->_urlModel
            ->getUrl(
                'customer/account/login',
                ['referer' => base64_encode($url)]
            );
        return $login_url;
    }
    public function formActionUrl()
    {
        $formUrl = $this->_urlModel
            ->getUrl('customization/index/save');
        return $formUrl;
    }

    public function getCurrentProduct()
    {
        return $this->_coreRegistry->registry('current_product');
    }

    public function getConfigValueRecaptcha()
    {
        return $this->scopeConfig->getValue(
            "recaptcha_frontend/type_recaptcha/public_key",
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $this->storeManager->getStore()->getStoreId()
        );
    }
    public function getConfigValueTabTitle()
    {
        return $this->scopeConfig->getValue(
            "customization/general/tab_name",
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $this->storeManager->getStore()->getStoreId()
        );
    }

    public function getConfigAllowGuestUser()
    {
        return $this->scopeConfig->getValue(
            "customization/general/allow_guest",
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $this->storeManager->getStore()->getStoreId()
        );
    }
    public function getCustomerDetails()
    {
    $customer = $this->customer;
    $customerName = $customer->getName();
    $customerId = $customer->getId();
    return $customerId;
    
    //You will get all basic detail with this $customer object
    }

    public function getGenuineUser()
    {
        $data=$this->collection->getData();
        foreach($data as $value){
            $trueUser=$value['remark'];
        }
        return $trueUser;
    }

    public function customerId() {
        $customerId = $this->sessionFactory->create()->getCustomer()->getId();
        return $customerId;
        }

    public function getTrueUser()
    {
        $customerId= $this->customerId();
        $data=$this->collection->getData();
        foreach($data as $value){
            if($value['customer_id'] == $customerId){
                if( $value['remark'] == 0 ){
                    return true;
                } else {
                    return false;
                }
            } 
        }
        return true;
    }
}