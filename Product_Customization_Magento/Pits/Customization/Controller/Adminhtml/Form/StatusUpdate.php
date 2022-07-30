<?php
namespace Pits\Customization\Controller\Adminhtml\Form;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Pits\Customization\Model\FormFactory;
use Pits\Customization\Model\ResourceModel\Form\Collection;
use Magento\Framework\App\Request\Http;
use Magento\Review\Helper\Data as StatusSource;

class StatusUpdate extends Action
{
    public $collection;
    protected $source;
    protected $formFactory;
    protected $_formFactory;

    public function __construct(
        Context $context,
        Collection $collection,
        \Pits\Customization\Model\FormFactory $formFactory,
        Http $request,
        StatusSource $source
    ) {
        $this->collection = $collection;
        $this->formFactory = $formFactory;
        $this->request = $request;
        $this->source = $source;
        parent::__construct($context);
    }

    public function execute()
    {
        $current_id = $this->request->getParam('id');
        $data=$this->collection->getData();
        foreach($data as $value){
            if($value['id']==$current_id){
                 $data['id'] = $current_id;
                $data['status']= '1';
                if ($data) {
                    $model = $this->formFactory->create();
                    $model->setData($data)->save();
                    $this->messageManager->addSuccessMessage(__("Status Updated."));   
                    break;
                }  
            }      
        }
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('customization/form/view',['id'=>$this->request->getParam('id')]);
    }

    
}

