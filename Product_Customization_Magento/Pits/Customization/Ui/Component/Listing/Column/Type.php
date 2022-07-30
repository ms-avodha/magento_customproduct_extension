<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Pits\Customization\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Class Type
 *
 * @api
 * @since 100.1.0
 */
class Type extends Column
{
    /**
     * {@inheritdoc
     * @since 100.1.0
     */
    public function prepareDataSource(array $dataSource)
    {
        $dataSource = parent::prepareDataSource($dataSource);

        if (empty($dataSource['data']['items'])) {
            return $dataSource;
        }

        foreach ($dataSource['data']['items'] as &$item) {
            $item['type'] = $this->getTypeLabel($item);
        }
        return $dataSource;
    }

    /**
     * Retrieve type label
     *
     * @param array $item
     * @return \Magento\Framework\Phrase
     * @since 100.1.0
     */
    protected function getTypeLabel(array $item)
    {
        if (!empty($item['customer_id'])) {
            return __('Customer');
        }

        return __('Guest');
    }
}
