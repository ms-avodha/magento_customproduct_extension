<?php
 
namespace Pits\Customization\Model;
 
use Pits\Customization\Api\CustomRepositoryInterface;
use Pits\Customization\Api\Data\CustomInterface;
use Pits\Customization\Api\Data\CustomSearchResultInterface;
use Pits\Customization\Api\Data\CustomSearchResultInterfaceFactory;
use Pits\Customization\Model\ResourceModel\Form\CollectionFactory as CustomCollectionFactory;
use Pits\Customization\Model\ResourceModel\Form\Collection;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\NoSuchEntityException;

class CustomRepository implements CustomRepositoryInterface
{
    /**
     * @var CustomFactory
     */
    private $customFactory;
 
    /**
     * @var CustomCollectionFactory
     */
    private $customCollectionFactory;
 
    /**
     * @var CustomSearchResultInterfaceFactory
     */
    private $searchResultFactory;
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;
 
    public function __construct(
        CustomFactory $customFactory,
        CustomCollectionFactory $customCollectionFactory,
        CustomSearchResultInterfaceFactory $customSearchResultInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->customFactory = $customFactory;
        $this->customCollectionFactory = $customCollectionFactory;
        $this->searchResultFactory = $customSearchResultInterfaceFactory;
       $this->collectionProcessor = collectionProcessor;
    }
 
    // ... getById, save and delete methods listed above ...
 
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
       $collection = $this->collectionFactory->create();
       $this->collectionProcessor->process($searchCriteria, ($collection));
       $searchResults = $this->searchResultFactory->create();
 
       $searchResults->setSearchCriteria($searchCriteria);
       $searchResults->setItems($collection->getItems());
 
       return $searchResults;
    } 

    public function getById($id)
    {
        $custom = $this->customFactory->create();
        $custom>getResource()->load($custom, $id);
        if (! $custom>getId()) {
        throw new NoSuchEntityException(__('Unable to find custom with ID "%1"', $id));
        }
        return $custom;
    }
    
    public function save(CustomInterface $custom)
    {
        $custom>getResource()->save($custom);
        return $custom;
    }
    
    public function delete(CustomInterface $custom)
    {
        $custom>getResource()->delete($custom);
    }
}

