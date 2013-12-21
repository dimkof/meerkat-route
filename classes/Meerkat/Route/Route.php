<?php

namespace Meerkat\Route;

/**
 *
 * @author alex
 */
class Route {

    /**
     * @param type $base_url
     * @return \Meerkat\Route\Route
     */
    static function factory($base_url) {
        return new Route(trim($base_url,'/'));
    }

    protected $base_url;
    protected $with_item = false;
    protected $directory = null;
    protected $controller;

    function __construct($base_url) {
        $base_url = trim($base_url, '/');
        $this->base_url = $base_url;
    }

    /**
     * 
     * @param type $directory
     * @return \Meerkat\Route\Route
     */
    function directory($directory) {
        $this->directory = $directory;
        return $this;
    }

    /**
     * 
     * @param type $with_item
     * @return \Meerkat\Route\Route
     */
    function with_item($with_item) {
        $this->with_item = $with_item;
        return $this;
    }

    /**
     * 
     * @param type $controller
     * @return \Meerkat\Route\Route
     */
    function controller($controller) {
        $this->controller = $controller;
        return $this;
    }

    function put() {
        if ($this->with_item) {
            $pattern = (true === $this->with_item) ? '([0-9]+)' : $this->with_item;
            \Route::set($this->base_url . '/<id>(/<action>)', $this->base_url . '/<id>(/<action>)', array('id' => $pattern))->defaults(
                    array(
                        'directory' => $this->directory,
                        'controller' => $this->controller,
                        'action' => 'item',
                    )
            );
        }

        \Route::set($this->base_url . '(/<action>)', $this->base_url . '(/<action>)')->defaults(
                array(
                    'directory' => $this->directory,
                    'controller' => $this->controller,
                    'action' => 'index',
                )
        );
    }
    
    static function module_roure($module, $app){
        $file_route = Arr::get(\Kohana::modules(),$module);
    }

}