<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Pits\Customization\Ui\Component\Listing\Column;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Review\Helper\Data as StatusSource;

/**
 * Class Status
 *
 * @api
 * @since 100.1.0
 */
class Status extends Column implements OptionSourceInterface
{
    /**
     * @var StatusSource
     * @since 100.1.0
     */
    protected $source;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param StatusSource $source
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        StatusSource $source,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->source = $source;
    }

    /**
     * {@inheritdoc}
     * @since 100.1.0
     */
    public function prepareDataSource(array $dataSource)
    {
        $dataSource = parent::prepareDataSource($dataSource);

        if (empty($dataSource['data']['items'])) {
            return $dataSource;
        }

        foreach ($dataSource['data']['items'] as &$item) {
            if (isset($item['status'])) {
                if ($item['status'] == 0) {
                    $item['status'] = "Pending";
                } elseif ($item['status'] == 1) {
                    $item['status'] = "Replied";
                }
            }
        }

        return $dataSource;
    }

    /**
     * {@inheritdoc}
     * @since 100.1.0
     */
    public function toOptionArray()
    {
        return [
            ['value' => 0, 'label' => 'Pending'],
            ['value' => 1, 'label' => 'Replied']
        ];
    }
}
