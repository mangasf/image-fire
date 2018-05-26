<?php

/* notification.twig */
class __TwigTemplate_da4a204c757cdfc0c474bb54d83e61b65b3adf4ec02832f92bbf6209b17b7640 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"\">
    <title>Image Fire</title>
    <link href=\"../../assets/css/bootstrap/bootstrap.min.css\" rel=\"stylesheet\">
    <link href=\"../../assets/css/index.css\" rel=\"stylesheet\">
    <link href='../../libs/dropzone/dropzone.css' type='text/css' rel='stylesheet'>
</head>
<body>
<nav class=\"navbar navbar-expand-lg navbar-dark bg-dark fixed-top\">
    <div class=\"container\">
        <a class=\"navbar-brand\" href=\"#\">
            <img class=\"logo\" src=\"../../assets/images/icon-fire.png\">Image Fire
        </a>
    </div>
</nav>
<div class=\"container container-notification\">
    <div class=\"row\">
        <div class=\"alert alert-";
        // line 23
        echo twig_escape_filter($this->env, ($context["type"] ?? null), "html", null, true);
        echo " img-fire-notification\" role=\"alert\">
            ";
        // line 24
        echo twig_escape_filter($this->env, ($context["message"] ?? null), "html", null, true);
        echo "
        </div>
    </div>
    <div class=\"row\">
        <a class=\"btn btn-outline-primary btn-sm btn-back\" role=\"button\" href=\"../../index.php\">Back</a>
    </div>
</div>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "notification.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  51 => 24,  47 => 23,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"\">
    <title>Image Fire</title>
    <link href=\"../../assets/css/bootstrap/bootstrap.min.css\" rel=\"stylesheet\">
    <link href=\"../../assets/css/index.css\" rel=\"stylesheet\">
    <link href='../../libs/dropzone/dropzone.css' type='text/css' rel='stylesheet'>
</head>
<body>
<nav class=\"navbar navbar-expand-lg navbar-dark bg-dark fixed-top\">
    <div class=\"container\">
        <a class=\"navbar-brand\" href=\"#\">
            <img class=\"logo\" src=\"../../assets/images/icon-fire.png\">Image Fire
        </a>
    </div>
</nav>
<div class=\"container container-notification\">
    <div class=\"row\">
        <div class=\"alert alert-{{ type }} img-fire-notification\" role=\"alert\">
            {{ message }}
        </div>
    </div>
    <div class=\"row\">
        <a class=\"btn btn-outline-primary btn-sm btn-back\" role=\"button\" href=\"../../index.php\">Back</a>
    </div>
</div>
</body>
</html>", "notification.twig", "/var/www/html/image-fire/templates/notification.twig");
    }
}
