<?php
/**
 * @package     HitarthPattani\BackendReindex
 * @author      Hitarth Pattani <hitarthpattani@gmail.com>
 * @copyright   Copyright © 2021. All rights reserved.
 */
declare(strict_types=1);

namespace HitarthPattani\BackendReindex\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Framework\Indexer\IndexerRegistry;

abstract class Indexer extends Action
{
    /**
     * Authorization level of a basic admin session
     */
    const ADMIN_RESOURCE = 'HitarthPattani_BackendReindex::reindex';

    /**
     * @var IndexerRegistry
     */
    protected $indexerRegistry;

    /**
     * Reindex constructor.
     *
     * @param Action\Context $context
     * @param IndexerRegistry $indexerRegistry
     */
    public function __construct(
        Action\Context $context,
        IndexerRegistry $indexerRegistry
    ) {
        $this->indexerRegistry = $indexerRegistry;
        parent::__construct($context);
    }
}
