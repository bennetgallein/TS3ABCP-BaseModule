<?php
/**
 * Created by PhpStorm.
 * User: bennet
 * Date: 02.11.18
 * Time: 09:47
 */

namespace Module\ExampleModule;

use Module\Module;
use Controllers\Panel;

class AntiRobotModule extends Module {

    private $name = "ExampleModule";

    private $version = "0.0.1";

    private $author = "Bennet Gallein <me@bennetgallein.de>";


    /**
     * UserModule constructor.
     */
    public function __construct() {
        parent::__construct($this->name, $this->version, $this->author);
        $this->interceptors();
        $this->routes();
    }

    private function routes() {
        $data = array(
            array("/example", "ExampleModule\Controllers\ExamplePage::render", ["engine" => Panel::getEngine()], "GET")
        );
        $this->_registerRoutes($data);

    }

    private function interceptors() {
        $data = array(
            array("/example", "ExampleModule\Controllers\ExamplePage::intercept")
        );
        $this->_registerInjectors($data);
    }
}
