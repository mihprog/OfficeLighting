<?php

//class, that renders templates
class Renderer
{
    /*returns Twig_Environment
     * input - string catalogue of templates for example 'templates'
     */
    static function getTwig($filesystem)
    {
        $loader = new Twig_Loader_Filesystem($filesystem);
        $twig = new Twig_Environment($loader);
        return $twig;

    }

    /*returns false
     * input - Twig_Environment object, path to template - string and
     * content of template - associative array
     */
    static function render($twig,$templatePath,$content)
    {

        $template = $twig->loadTemplate($templatePath);
        echo $template->render($content);
        return false;
    }
}