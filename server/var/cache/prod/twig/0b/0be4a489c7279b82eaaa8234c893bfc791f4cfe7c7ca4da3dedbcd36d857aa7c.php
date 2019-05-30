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

/* @Framework/Form/form_row.html.php */
class __TwigTemplate_d8bc5e72e9eacba1ca6fd251efe1a688d06c889fefa5bb434700502c974d1030 extends \Twig\Template
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
        echo "<div>
    <?php \$widgetAttr = empty(\$help) ? [] : ['attr' => ['aria-describedby' => \$id.'_help']]; ?>
    <?php echo \$view['form']->label(\$form); ?>
    <?php echo \$view['form']->errors(\$form); ?>
    <?php echo \$view['form']->widget(\$form, \$widgetAttr); ?>
    <?php echo \$view['form']->help(\$form); ?>
</div>
";
    }

    public function getTemplateName()
    {
        return "@Framework/Form/form_row.html.php";
    }

    public function getDebugInfo()
    {
        return array (  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "@Framework/Form/form_row.html.php", "/Users/ickarakurt/Desktop/webhelper/server/vendor/symfony/framework-bundle/Resources/views/Form/form_row.html.php");
    }
}
