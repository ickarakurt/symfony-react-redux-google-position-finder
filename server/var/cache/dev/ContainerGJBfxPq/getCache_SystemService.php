<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'cache.system' shared service.

include_once $this->targetDirs[3].'/vendor/symfony/cache/Traits/AbstractTrait.php';
include_once $this->targetDirs[3].'/vendor/symfony/contracts/Cache/CacheTrait.php';
include_once $this->targetDirs[3].'/vendor/symfony/cache/Traits/ContractsTrait.php';
include_once $this->targetDirs[3].'/vendor/symfony/cache/Adapter/AbstractAdapter.php';

return $this->services['cache.system'] = \Symfony\Component\Cache\Adapter\AbstractAdapter::createSystemCache('Sxgx00jSaS', 0, $this->getParameter('container.build_id'), ($this->targetDirs[0].'/pools'), ($this->privates['logger'] ?? ($this->privates['logger'] = new \Symfony\Component\HttpKernel\Log\Logger())));