<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\GlueStorefrontApiApplicationAuthorizationConnector;

use Spryker\Glue\GlueStorefrontApiApplicationAuthorizationConnector\ConfigExtractorStrategy\AuthorizationStrategyAwareResourceRoutePluginConfigExtractorStrategy;
use Spryker\Glue\GlueStorefrontApiApplicationAuthorizationConnector\ConfigExtractorStrategy\ConfigExtractorStrategyInterface;
use Spryker\Glue\GlueStorefrontApiApplicationAuthorizationConnector\ConfigExtractorStrategy\DefaultAuthorizationStrategyAwareResourceRoutePluginConfigExtractorStrategy;
use Spryker\Glue\GlueStorefrontApiApplicationAuthorizationConnector\Dependency\Client\GlueStorefrontApiApplicationAuthorizationConnectorToAuthorizationClientInterface;
use Spryker\Glue\GlueStorefrontApiApplicationAuthorizationConnector\Processor\AuthorizationValidator\AuthorizationValidator;
use Spryker\Glue\GlueStorefrontApiApplicationAuthorizationConnector\Processor\AuthorizationValidator\AuthorizationValidatorInterface;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \Spryker\Glue\GlueStorefrontApiApplicationAuthorizationConnector\GlueStorefrontApiApplicationAuthorizationConnectorConfig getConfig()
 */
class GlueStorefrontApiApplicationAuthorizationConnectorFactory extends AbstractFactory
{
    public function createAuthorizationValidator(): AuthorizationValidatorInterface
    {
        return new AuthorizationValidator(
            $this->getAuthorizationClient(),
            $this->getConfigExtractorStrategies(),
            $this->getConfig(),
        );
    }

    public function getAuthorizationClient(): GlueStorefrontApiApplicationAuthorizationConnectorToAuthorizationClientInterface
    {
        return $this->getProvidedDependency(GlueStorefrontApiApplicationAuthorizationConnectorDependencyProvider::CLIENT_AUTHORIZATION);
    }

    /**
     * @return array<\Spryker\Glue\GlueStorefrontApiApplicationAuthorizationConnector\ConfigExtractorStrategy\ConfigExtractorStrategyInterface>
     */
    public function getConfigExtractorStrategies(): array
    {
        return [
           $this->createAuthorizationStrategyAwareResourceRoutePluginConfigExtractorStrategy(),
           $this->createDefaultAuthorizationStrategyAwareResourceRoutePluginConfigExtractorStrategy(),
        ];
    }

    public function createAuthorizationStrategyAwareResourceRoutePluginConfigExtractorStrategy(): ConfigExtractorStrategyInterface
    {
        return new AuthorizationStrategyAwareResourceRoutePluginConfigExtractorStrategy();
    }

    public function createDefaultAuthorizationStrategyAwareResourceRoutePluginConfigExtractorStrategy(): ConfigExtractorStrategyInterface
    {
        return new DefaultAuthorizationStrategyAwareResourceRoutePluginConfigExtractorStrategy();
    }
}
