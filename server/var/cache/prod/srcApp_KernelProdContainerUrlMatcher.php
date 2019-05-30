<?php

use Symfony\Component\Routing\Matcher\Dumper\PhpMatcherTrait;
use Symfony\Component\Routing\RequestContext;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class srcApp_KernelProdContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    use PhpMatcherTrait;

    public function __construct(RequestContext $context)
    {
        $this->context = $context;
        $this->staticRoutes = [
            '/api/main' => [[['_route' => 'app_main_index', '_controller' => 'App\\Controller\\MainController::index'], null, null, null, false, false, null]],
            '/api/register' => [[['_route' => 'api_register', '_controller' => 'App\\Controller\\RegisterController::index'], null, ['POST' => 0], null, false, false, null]],
            '/api/login' => [[['_route' => 'api_login_check'], null, null, null, false, false, null]],
        ];
    }
}
