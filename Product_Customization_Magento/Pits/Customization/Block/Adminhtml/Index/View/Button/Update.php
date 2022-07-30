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

class Update extends Generic implements ButtonProviderInterface
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
            'label' => __('Update'),
            'class' => 'save primary',
            'on_click' => sprintf("location.href = '%s';", $this->getUpdateUrl()),
            'sort_order' => 20,
        ];
    }

    public function getUpdateUrl()
    {
        return $this->getUrl('customization/form/statusUpdate',['id'=>$this->request->getParam('id'), 'status' =>$this->request->getParam('status')]);
    }

}

