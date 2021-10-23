<?php
/**
 * @package     HitarthPattani\BackendReindex
 * @author      Hitarth Pattani <hitarthpattani@gmail.com>
 * @copyright   Copyright © 2021. All rights reserved.
 */
declare(strict_types=1);

namespace HitarthPattani\BackendReindex\Controller\Adminhtml\Indexer;

use Exception;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Indexer\IndexerInterface;
use HitarthPattani\BackendReindex\Controller\Adminhtml\Indexer;

class MassReindex extends Indexer
{
    /**
     * Display processes grid action
     *
     * @return void
     */
    public function execute()
    {
        $indexerIds = $this->getRequest()->getParam('indexer_ids');
        if (!is_array($indexerIds)) {
            $this->messageManager->addErrorMessage(__('Please select indexers.'));
        } else {
            try {
                foreach ($indexerIds as $indexerId) {
                    /** @var IndexerInterface $indexer */
                    $indexer = $this->indexerRegistry->get($indexerId);
                    $indexer->reindexAll();
                }
                // phpcs:disable Generic.Files.LineLength.TooLong
                $this->messageManager->addSuccessMessage(__('Total of %1 index(es) have reindexed data.', count($indexerIds)));
                // phpcs:enable
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Cannot initialize the indexer process.'));
            }
        }
        $this->_redirect('*/*/list');
    }
}
