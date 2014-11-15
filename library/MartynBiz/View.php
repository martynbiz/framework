<?php

namespace MartynBiz;

use Handlebars\Handlebars;

class View extends \Slim\View
{
    protected $layout;
    protected $engine;
    
    public function __construct($layout)
    {
        $this->layout = $layout;
        $this->engine = new Handlebars;
        
        parent::__construct();
    }
    
    /**
     * Set the layout path
     *
     * @return void
     * @author Martyn Bissett
     **/
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
    
    /**
     * Set the layout path
     *
     * @return void
     * @author Martyn Bissett
     **/
    public function embed($templatePathname, $data)
    {
        ob_start();
        require $templatePathname;
        $template = ob_get_clean();
        
        return $this->engine->render($template, $data );
    }
    
    /**
     * Render the template within the layout
     *
     * @return void
     * @author Martyn Bissett
     **/
    public function render($template, $data=array())
    {
        $layoutPathname = $this->getTemplatePathname($this->layout);
        if (!is_file($layoutPathname)) {
            throw new \RuntimeException("View cannot render `$this->layout` because the template does not exist");
        }
        
        $templatePathname = $this->getTemplatePathname($template);
        if (!is_file($templatePathname)) {
            throw new \RuntimeException("View cannot render `$template` because the template does not exist");
        }

        $data = array_merge($this->data->all(), (array) $data);
        extract($data);
        ob_start();
        require $layoutPathname;

        return ob_get_clean();
    }
}