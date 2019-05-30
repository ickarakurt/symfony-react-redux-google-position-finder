<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* @Twig/Exception/error.html.twig */
class __TwigTemplate_17610b15dc7fa05b7ca839df552e245c64c4e6b901289fd36cc21b19463dc849 extends \Twig\Template
{
    private $source;

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getCharset(), "html", null, true);
        echo "\" />
        <title>An Error Occurred: ";
        // line 5
        echo twig_escape_filter($this->env, ($context["status_text"] ?? null), "html", null, true);
        echo "</title>
        <style>
            body { background-color: #fff; color: #222; font: 16px/1.5 -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, sans-serif; margin: 0; }
            .container { margin: 30px; max-width: 600px; }
            h1 { color: #dc3545; font-size: 24px; }
            h2 { font-size: 18px; }
        </style>
    </head>
    <body>
        <div class=\"container\">
            <h1>Oops! An Error Occurred</h1>
            <h2>The server returned a \"";
        // line 16
        echo twig_escape_filter($this->env, ($context["status_code"] ?? null), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, ($context["status_text"] ?? null), "html", null, true);
        echo "\".</h2>

            <p>
                Something is broken. Please let us know what you were doing when this error occurred.
                We will fix it as soon as possible. Sorry for any inconvenience caused.
            </p>
        </div>
    </body>
</html>
";
    }

    public function getTemplateName()
    {
        return "@Twig/Exception/error.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  58 => 16,  44 => 5,  40 => 4,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "@Twig/Exception/error.html.twig", "/Users/ickarakurt/Desktop/webhelper/server/vendor/symfony/twig-bundle/Resources/views/Exception/error.html.twig");
    }
}
