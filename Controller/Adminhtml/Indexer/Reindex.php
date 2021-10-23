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
use HitarthPattani\BackendReindex\Controller\Adminhtml\Indexer;

class Reindex extends Indexer
{
    /**
     * Display processes grid action
     *
     * @return void
     */
    public function execute()
    {
        $indexerId = $this->getRequest()->getParam('id');
        $indexer = $this->indexerRegistry->get($indexerId);
        if ($indexer && $indexer->getId()) {
            try {
                $indexer->reindexAll();

                $this->messageManager->addSuccessMessage(__('%1 index was rebuilt.', $indexer->getTitle()));
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('There was a problem with reindexing process.'));
            }
        } else {
            $this->messageManager->addErrorMessage(__('Cannot initialize the indexer process.'));
        }
        $this->_redirect('*/*/list');
    }
}
