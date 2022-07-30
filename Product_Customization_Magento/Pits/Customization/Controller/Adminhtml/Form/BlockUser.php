<?php
namespace Pits\Customization\Controller\Adminhtml\Form;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Pits\Customization\Model\FormFactory;
use Pits\Customization\Model\ResourceModel\Form\Collection;
use Magento\Framework\App\Request\Http;
use Magento\Review\Helper\Data as StatusSource;

class BlockUser extends Action
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
        echo "<pre>";
        foreach($data as $value){
            if($value['id']==$current_id){
                $customer_id=$value['customer_id'];
                break;
            }
        }
        $success=0;
        foreach($data as $value){
            if($value['customer_id'] !=0){
                if($value['customer_id']==$customer_id){
                    $value['remark']= '1';
                    if ($value) {
                        $model = $this->formFactory->create();
                        $model->setData($value)->save(); 
                    }  
                    $success=1;
                }  
            }  
            else{
                if($value['id']==$current_id){
                    $data['id'] = $current_id;
                   $data['remark']= '1';
                   if ($data) {
                       $model = $this->formFactory->create();
                       $model->setData($data)->save();
                       $this->messageManager->addSuccessMessage(__("Spam Message Identified."));   
                       break;
                   }  
               }      
            }  
        }
        if($success==1){
        $this->messageManager->addSuccessMessage(__("Spam Account Identified."));  
        }
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('customization/form/view',['id'=>$this->request->getParam('id')]);

    }

    
}

