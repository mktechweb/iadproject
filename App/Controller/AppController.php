<?php
namespace App\Controller;

class AppController
{
	protected  $template = 'layout';

	public function __construct()
    {
        $this->viewPath = ROOTDIR . '/App/Views/';
    }

    protected function render($view, $variables = [])
    {
        ob_start();
        extract($variables);
        require($this->viewPath . str_replace('.', '/', $view) . '.php');
        $content = ob_get_clean();
        require($this->viewPath . $this->template . '.php');
    }
}