<?php
 
namespace Pits\Customization\Model;
 
use Magento\Framework\Model\AbstractExtensibleModel;
use Pits\Customization\Api\Data\CustomExtensionInterface;
use Pits\Customization\Api\Data\CustomInterface;
 
class Custom extends AbstractExtensibleModel implements CustomInterface
{
    const CREATED = 'created';
    const NAME = 'name';
    const EMAIL = 'email';
    const PHONE = 'phone';
    const REQUIREMENT = 'requirement';
    const PRODUCTNAME = 'productname';
    const SKU = 'sku';
    const ENTITYID = 'entityId';
 
    protected function _construct()
    {
        $this->_init(ResourceModel\Custom::class);
    }

    /**
     * @inheritDoc
     */
    public function getCreated()
    {
        return $this->_getData(self::CREATED);
    }
    /**
     * @inheritDoc
     */
    public function setCreated($created)
    {
        $this->setData(self::CREATED);
    }
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->_getData(self::NAME);
    }
    /**
     * @inheritDoc
     */
    public function setName($name)
    {
        $this->setData(self::NAME);
    }

    /**
     * @inheritDoc
     */
    public function getEmail()
    {
        return $this->_getData(self::EMAIL);
    }
    /**
     * @inheritDoc
     */
    public function setEmail($email)
    {
        $this->setData(self::EMAIL);
    }

    /**
     * @inheritDoc
     */
    public function getPhone()
    {
        return $this->_getData(self::PHONE);
    }
    /**
     * @inheritDoc
     */
    public function setPhone($phone)
    {
        $this->setData(self::PHONE);
    }
    
    /**
     * @inheritDoc
     */
    public function getRequirement()
    {
        return $this->_getData(self::REQUIREMENT);
    }
    /**
     * @inheritDoc
     */
    public function setRequirement($requirement)
    {
        $this->setData(self::REQUIREMENT);
    }

    /**
     * @inheritDoc
     */
    public function getProductname()
    {
        return $this->_getData(self::PRODUCTNAME);
    }
    /**
     * @inheritDoc
     */
    public function setProductname($productname)
    {
        $this->setData(self::PRODUCTNAME);
    }

    /**
     * @inheritDoc
     */
    public function getSku()
    {
        return $this->_getData(self::SKU);
    }
    /**
     * @inheritDoc
     */
    public function setSku($sku)
    {
        $this->setData(self::SKU);
    }

    public function getEntityId()
    {
        return $this->_getData(self::SKU);
    }
    /**
     * @inheritDoc
     */
    public function setEntityId($entityId)
    {
        $this->setData(self::ENTITYID);
    }
}