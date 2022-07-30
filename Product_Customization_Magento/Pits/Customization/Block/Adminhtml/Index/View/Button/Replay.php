<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 *
 * Created By: MageDelight Pvt. Ltd.
 */
namespace Pits\Customization\Block\Adminhtml\Index\View\Button;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Pits\Customization\Model\ResourceModel\Form\CollectionFactory as FormFactory;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\App\Request\Http;

class Replay extends Generic implements ButtonProviderInterface
{
    protected $_formFactory;
    /**
     * Get button data
     *
     * @return array
     */
    public function __construct(
        Context $context,
        FormFactory $formFactory,
        Http $request
    )
    {
        $this->formFactory = $formFactory;
        $this->request = $request;
        parent::__construct($context);
    }
 
    public function getButtonData()
    {
        return [
            'label' => __('Reply'),
            'class' => 'save primary',
            'on_click' => sprintf("location.href = '%s';", $this->getEmail()),
            'sort_order' => 10,
        ];
    }
    /**
     * Get URL for back (reset) button
     *
     * @return string
     */
    public function getEmail()
    {
        // return $this->getUrl('*/*/');
        $current_id = $this->request->getParam('id');
        $model = $this->formFactory->create()
        ->addFieldToSelect('*')
        ->addFieldToFilter('id',
                ['eq' => $current_id ]
            )->getFirstItem();
        $collection = $model->getCollection();
        $email="mailto:".$model->getEmail();
        return  $email;
    }
}

