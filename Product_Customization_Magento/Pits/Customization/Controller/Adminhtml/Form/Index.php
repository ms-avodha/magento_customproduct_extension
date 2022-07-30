<?php

namespace Pits\Customization\Controller\Adminhtml\Form;

class Index extends \Magento\Backend\App\Action
{
	protected $resultPageFactory = false;
	const ADMIN_RESOURCE = 'Pits_Customization::form';
	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
	)
	{
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;
	}

	public function execute()
	{
		$resultPage = $this->resultPageFactory->create();
		$resultPage->getConfig()->getTitle()->prepend((__('All Customizations')));

		return $resultPage;
	}


}