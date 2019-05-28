<?php
namespace App\Controller;


class AppController
{
	protected  $template = 'template';

    protected function render($view, $variables = [])
    {
        ob_start();
        extract($variables);
        require(ROOTDIR . '/App/Views/'. str_replace('.', '/', $view) . '.php');
        $content = ob_get_clean();
        require(ROOTDIR . '/App/Views/' .  $this->template . '.php');
    }
}