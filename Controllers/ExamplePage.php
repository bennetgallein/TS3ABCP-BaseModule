<?php
/**
 * Created by PhpStorm.
 * User: bennet
 * Date: 17.04.19
 * Time: 16:04
 */

namespace Module\ExampleModule\Controllers;

use Controllers\Panel;

class ExamplePage {

    public function __call($name, $arguments) {
        return call_user_func_array(array($this, $name), $arguments);
    }

    /**
     * This function renders the file to the user. It makes use of a custom templating engine, which is documented in the documentation
     *
     * @param Engine $engine
     * @return void
     */
    private function render(Engine $engine) {

        $param1 = "test parameter";
        $param2 = "2nd test parameter";

        Panel::render($engine->compile("_views/" . THEME . "/path/to/file.html", array(
            "parameter1" => $param1,
            "parameter2" => $param2,
            "paramarray" => array("test", "test2", "test3", "test4")
        )));
    }

    /**
     * this function is an interceptor to modify the content send to the user
     *
     * @param string $content the plain html content coming from the original function
     * @return string $content this is the content that then will be rendered to the user
     */
    private function intercept(string $content) {
        // modify the string here
        // example: replace $param1 from the function above with something else
        $content = preg_replace("/test parameter/", "this is a replacement", $content);

        return $content;
    }
}