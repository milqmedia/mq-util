<?php
/**
 * MQUtil
 * Copyright (c) 2014 Milq Media.
 *
 * @author      Johan Kuijt <johan@milq.nl>
 * @copyright   2014 Milq Media.
 * @license     http://www.opensource.org/licenses/mit-license.php  MIT License
 * @link        http://milq.nl
 */
 
use MQUtil\View\Helper\Js;
use MQUtil\Module;

class JsTest extends \PHPUnit_Framework_TestCase
{
    /** @var Js */
    protected $jsHelper;
    
    /** @var array */
    protected $config;

    public function setUp()
    {
	    $this->config = array(
							'assetsConfigPath' 		=> __DIR__ . '/../../../data',
						);
    }

    public function testViewHelperConfigValid()
    {
        $jsHelper = new Js($this->config);
        
        $this->assertInstanceOf('MQUtil\View\Helper\Js', $jsHelper);
    }
    
    public function testCanInvokeViewHelper()
    {
        $jsHelper = new Js($this->config);
        
        $jsPath = $jsHelper('test');
        
        $this->assertEquals($jsPath, '/assets/js/test.827e75cb.js');
    }
}