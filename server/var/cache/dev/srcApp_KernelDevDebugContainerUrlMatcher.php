<?php

use Symfony\Component\Routing\Matcher\Dumper\PhpMatcherTrait;
use Symfony\Component\Routing\RequestContext;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class srcApp_KernelDevDebugContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    use PhpMatcherTrait;

    public function __construct(RequestContext $context)
    {
        $this->context = $context;
        $this->staticRoutes = [
            '/api/keyword' => [[['_route' => 'app_keywordcountroller_add', '_controller' => 'App\\Controller\\KeywordCountroller::add'], null, ['POST' => 0], null, false, false, null]],
            '/api/updatekeyword' => [[['_route' => 'app_keywordcountroller_updaterank', '_controller' => 'App\\Controller\\KeywordCountroller::updateRank'], null, ['POST' => 0], null, false, false, null]],
            '/api/project' => [
                [['_route' => 'app_project_add', '_controller' => 'App\\Controller\\ProjectController::add'], null, ['POST' => 0], null, false, false, null],
                [['_route' => 'app_project_getprojects', '_controller' => 'App\\Controller\\ProjectController::getProjects'], null, ['GET' => 0], null, false, false, null],
            ],
            '/api/project/position' => [[['_route' => 'app_project_delete', '_controller' => 'App\\Controller\\ProjectController::delete'], null, ['POST' => 0], null, false, false, null]],
            '/api/register' => [[['_route' => 'api_register', '_controller' => 'App\\Controller\\RegisterController::index'], null, ['POST' => 0], null, false, false, null]],
            '/api/checkToken' => [[['_route' => 'api_check_token', '_controller' => 'App\\Controller\\RegisterController::tokenChecker'], null, ['POST' => 0], null, false, false, null]],
            '/api/login' => [[['_route' => 'api_login_check'], null, null, null, false, false, null]],
        ];
        $this->regexpList = [
            0 => '{^(?'
                    .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                    .'|/api/project/([^/]++)(*:63)'
                .')/?$}sDu',
        ];
        $this->dynamicRoutes = [
            35 => [[['_route' => '_twig_error_test', '_controller' => 'twig.controller.preview_error::previewErrorPageAction', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
            63 => [[['_route' => 'app_project_getkeywords', '_controller' => 'App\\Controller\\ProjectController::getKeywords'], ['url'], ['GET' => 0], null, false, true, null]],
        ];
    }
}
