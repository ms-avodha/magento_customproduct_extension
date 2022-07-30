<?php
namespace Pits\Customization\Model\ResourceModel\Form;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
      $this->_init('Pits\Customization\Model\Form','Pits\Customization\Model\ResourceModel\Form');  
    }
}