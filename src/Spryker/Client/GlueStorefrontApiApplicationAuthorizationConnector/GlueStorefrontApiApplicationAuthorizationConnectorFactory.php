<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\GlueStorefrontApiApplicationAuthorizationConnector;

use Spryker\Client\GlueStorefrontApiApplicationAuthorizationConnector\Processor\ProtectedPathAuthorization\Checker\ProtectedPathAuthorizationChecker;
use Spryker\Client\GlueStorefrontApiApplicationAuthorizationConnector\Processor\ProtectedPathAuthorization\Checker\ProtectedPathAuthorizationCheckerInterface;
use Spryker\Client\GlueStorefrontApiApplicationAuthorizationConnector\Processor\ProtectedPathAuthorization\Expander\ProtectedPathAuthorizationExpander;
use Spryker\Client\GlueStorefrontApiApplicationAuthorizationConnector\Processor\ProtectedPathAuthorization\Expander\ProtectedPathAuthorizationExpanderInterface;
use Spryker\Client\Kernel\AbstractFactory;

/**
 * @method \Spryker\Client\GlueStorefrontApiApplicationAuthorizationConnector\GlueStorefrontApiApplicationAuthorizationConnectorConfig getConfig()
 */
class GlueStorefrontApiApplicationAuthorizationConnectorFactory extends AbstractFactory
{
    public function createProtectedPathAuthorizationChecker(): ProtectedPathAuthorizationCheckerInterface
    {
        return new ProtectedPathAuthorizationChecker($this->getConfig());
    }

    public function createProtectedPathAuthorizationExpander(): ProtectedPathAuthorizationExpanderInterface
    {
        return new ProtectedPathAuthorizationExpander($this->createProtectedPathAuthorizationChecker());
    }
}
