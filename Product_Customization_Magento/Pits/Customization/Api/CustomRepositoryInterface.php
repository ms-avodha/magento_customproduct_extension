<?php

namespace Pits\Customization\Api;

// use Magento\Framework\Api\SearchCriteriaInterface;
// use Pits\Customization\Api\Data\FormInterface;
// interface FormRepositoryInterface
// {
//     public function save(FormInterface $data);
// }

 
use Magento\Framework\Api\SearchCriteriaInterface;
use Pits\Customization\Api\Data\CustomInterface;
 
interface CustomRepositoryInterface
{
    /**
     * @param int $id
     * @return \Pits\Customization\Api\Data\CustomInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);
 
    /**
     * @param \Pits\Customization\Api\Data\CustomInterface $data
     * @return \Pits\Customization\Api\Data\customInterface
     */
    public function save(CustomInterface $data);
 
    /**
     * @param \Pits\Customization\Api\Data\CustomInterface $data
     * @return void
     */
   public function delete(CustomInterface $data);
 
    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Pits\Customization\Api\Data\CustomSearchResultInterface
     */
   public function getList(SearchCriteriaInterface $searchCriteria);
}