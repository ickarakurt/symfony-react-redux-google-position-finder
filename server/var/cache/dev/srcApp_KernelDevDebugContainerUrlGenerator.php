<?php

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Psr\Log\LoggerInterface;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class srcApp_KernelDevDebugContainerUrlGenerator extends Symfony\Component\Routing\Generator\UrlGenerator
{
    private static $declaredRoutes;
    private $defaultLocale;

    public function __construct(RequestContext $context, LoggerInterface $logger = null, string $defaultLocale = null)
    {
        $this->context = $context;
        $this->logger = $logger;
        $this->defaultLocale = $defaultLocale;
        if (null === self::$declaredRoutes) {
            self::$declaredRoutes = [
        '_twig_error_test' => [['code', '_format'], ['_controller' => 'twig.controller.preview_error::previewErrorPageAction', '_format' => 'html'], ['code' => '\\d+'], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '\\d+', 'code', true], ['text', '/_error']], [], []],
        'app_keywordcountroller_add' => [[], ['_controller' => 'App\\Controller\\KeywordCountroller::add'], [], [['text', '/api/keyword']], [], []],
        'app_keywordcountroller_updaterank' => [[], ['_controller' => 'App\\Controller\\KeywordCountroller::updateRank'], [], [['text', '/api/updatekeyword']], [], []],
        'app_project_add' => [[], ['_controller' => 'App\\Controller\\ProjectController::add'], [], [['text', '/api/project']], [], []],
        'app_project_getprojects' => [[], ['_controller' => 'App\\Controller\\ProjectController::getProjects'], [], [['text', '/api/project']], [], []],
        'app_project_delete' => [[], ['_controller' => 'App\\Controller\\ProjectController::delete'], [], [['text', '/api/project/position']], [], []],
        'app_project_getkeywords' => [['url'], ['_controller' => 'App\\Controller\\ProjectController::getKeywords'], [], [['variable', '/', '[^/]++', 'url', true], ['text', '/api/project']], [], []],
        'api_register' => [[], ['_controller' => 'App\\Controller\\RegisterController::index'], [], [['text', '/api/register']], [], []],
        'api_login_check' => [[], [], [], [['text', '/api/login']], [], []],
    ];
        }
    }

    public function generate($name, $parameters = [], $referenceType = self::ABSOLUTE_PATH)
    {
        $locale = $parameters['_locale']
            ?? $this->context->getParameter('_locale')
            ?: $this->defaultLocale;

        if (null !== $locale && null !== $name) {
            do {
                if ((self::$declaredRoutes[$name.'.'.$locale][1]['_canonical_route'] ?? null) === $name) {
                    unset($parameters['_locale']);
                    $name .= '.'.$locale;
                    break;
                }
            } while (false !== $locale = strstr($locale, '_', true));
        }

        if (!isset(self::$declaredRoutes[$name])) {
            throw new RouteNotFoundException(sprintf('Unable to generate a URL for the named route "%s" as such route does not exist.', $name));
        }

        list($variables, $defaults, $requirements, $tokens, $hostTokens, $requiredSchemes) = self::$declaredRoutes[$name];

        return $this->doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $referenceType, $hostTokens, $requiredSchemes);
    }
}
