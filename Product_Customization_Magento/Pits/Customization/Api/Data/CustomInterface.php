<?php
// namespace Pits\Customization\Api\Data;

// interface FormInterface
// {
//     const TABLE          = 'custom_details';
//     const ID             = 'id';
//     const FORMCREATED = 'created';
//     const FORMNAME       = 'name';
//     const FORMEMAIL = 'email';
//     const FORMPHONE = 'phone';
//     const FORMREQUIREMENT = 'requirement';
//     const FORMPRODUCTNAME = 'productName';
//     const FORMSKU = 'sku';
//     public function getId();
//     public function setId($id);
//     public function getCreated();
//     public function setCreated($created);
//     public function getName();
//     public function setName($name);
//     public function setEmail($email);
//     public function getEmail();
//     public function setPhone($phone);
//     public function getPhone();
//     public function setRequirement($requirement);
//     public function getRequirement();
//     public function setProductName($productname);
//     public function getProductName();
//     public function setSku($sku);
//     public function getSku();
// }


 
namespace Pits\Customization\Api\Data;
 
use Magento\Framework\Api\ExtensibleDataInterface;
 
interface CustomInterface extends ExtensibleDataInterface
{
    /**
     * @return int
     */
    public function getId();
 
    /**
     * @param int $id
     * @return void
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getCreated();
 
    /**
    * @param string $created
    * @return void
    */
    public function setCreated($created);
 
    /**
     * @return string
     */
    public function getName();
 
    /**
    * @param string $name
    * @return void
    */
    public function setName($name);

    /**
     * @return string
     */
    public function getEmail();
 
    /**
    * @param string $email
    * @return void
    */
    public function setEmail($email);

    /**
     * @return string
     */
    public function getPhone();
 
    /**
    * @param string $phone
    * @return void
    */
    public function setPhone($phone);

    /**
     * @return string
     */
    public function getRequirement();
 
    /**
    * @param string $requirement
    * @return void
    */
    public function setRequirement($requirement);

    /**
     * @return string
     */
    public function getProductName();
 
    /**
    * @param string $productName
    * @return void
    */
    public function setProductName($productName);

    /**
     * @return string
     */
    public function getSku();
 
    /**
    * @param string $sku
    * @return void
    */
    public function setSku($sku);
}



