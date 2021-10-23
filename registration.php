<?php
/**
 * @package     HitarthPattani\BackendReindex
 * @author      Hitarth Pattani <hitarthpattani@gmail.com>
 * @copyright   Copyright © 2021. All rights reserved.
 */
declare(strict_types=1);

use Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(ComponentRegistrar::MODULE, 'HitarthPattani_BackendReindex', __DIR__);
