<?php
namespace Pits\Customization\Model;
use Pits\Customization\Api\Data\FormInterface;

class Form extends \Magento\Framework\Model\AbstractModel 
{
    protected $_eventPrefix = 'pits_Customization_form';
    protected function _construct()

    {
        $this->_init('Pits\Customization\Model\ResourceModel\Form');
    }
    
}
    