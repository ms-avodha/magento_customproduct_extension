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
class Remark extends Column implements OptionSourceInterface
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
            if (isset($item['remark'])) {
                if ($item['remark'] == 0) {
                    $item['remark'] = "Genuine Request";
                } elseif ($item['remark'] == 1) {
                    $item['remark'] = "Spam Request";
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
            ['value' => 0, 'label' => 'Genuine Request'],
            ['value' => 1, 'label' => 'Spam Request']
        ];
    }
}
