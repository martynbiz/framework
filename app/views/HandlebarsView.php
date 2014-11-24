<?php

namespace App\View;

use MartynBiz\View;

class HandlebarsView extends View
{
    /**
    * Engine we will use to 
    */ 
    protected $engine;
    
    /**
     * Constructor.
     *
     * @param $engine Handlebars template engine
     * @return void
     * @author Martyn Bissett
     **/
    public function __construct($engine)
    {
        $this->engine = $engine;
    }
    
    /**
     * Require the template allows us to use PHP includes within in. This 
     * will return the template engine compiled result of the template and data
     * Used within the layout e.g. $this->yield($data)
     *
     * @param $data Data to compile template with
     * @return string The result of the template and data being compiled
     * @author Martyn Bissett
     **/
    public function embed($data=array())
    {
        // set full template path
        $templatePath = $this->getTemplatePath($this->template);
        
        // get the template. This method allows us to use PHP code (e.g. include) 
        // within the template files. file_get_contents wouldn't allow that.
        ob_start();
        require $templatePath;
        $template = ob_get_clean();
        
        // compile the template and the data, and return
        return $this->engine->render( $template, $data );
    }
    
    /**
     * Render the template within the layout
     *
     * @return void
     * @author Martyn Bissett
     **/
    public function render($data=array())
    {
        // if this is an XHR request, return json **test
        if ($this->isAjax()) {
            return json_encode($data);
        }
        
        return parent::render($data);   
    }
}