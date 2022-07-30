<?php
 
namespace Pits\Customization\Api\Data;
 
use Magento\Framework\Api\SearchResultsInterface;
 
interface CustomSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return \Pits\Customization\Api\Data\CustomInterface[]
     */
    public function getItems();
 
    /**
     * @param \Pits\Customization\Api\Data\CustomInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}