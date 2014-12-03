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
 
use MQUtil\View\Helper\Less;
use MQUtil\Module;

class LessTest extends \PHPUnit_Framework_TestCase
{
    /** @var Less */
    protected $lessHelper;
    
    /** @var array */
    protected $config;

    public function setUp()
    {
	    $this->config = array(
							'source' 		=> __DIR__ . '/../../../data',
							'outputPath' 	=> __DIR__ . '/../../../data',
							'publicPath' 	=> __DIR__ . 'css',
						);
	    
        $lessc = new \lessc();

        $this->lessHelper = new Less($lessc, $this->config);
    }

    public function testLesscGetsCalledOnInvoke()
    {
        // ----------------------------------------------------------------
        // setup test parameters
        //
        $filename = 'test.less';
        $cssPath = $this->config['publicPath'] . '/test.css?' . filemtime($this->config['source'] . '/'. $filename);
			
        // ----------------------------------------------------------------
        // execute
        //
        $lessHelper = $this->lessHelper;
        $cssFile = $lessHelper($filename);

        // ----------------------------------------------------------------
        // test the results
        //
        $this->assertEquals($cssFile, $cssPath);
    }
    
    public function testLesscComplingLessCorrectly()
    {
        // ----------------------------------------------------------------
        // setup test parameters
        //
        $filename = 'test.less';
		$expectedCss = file_get_contents($this->config['source'] . '/test_expected.css');
	
        // ----------------------------------------------------------------
        // execute
        //
        $lessHelper = $this->lessHelper;
        $lessHelper($filename);
		
		$compiledCss = file_get_contents($this->config['source'] . '/test.css');
		
        // ----------------------------------------------------------------
        // test the results
        //
        $this->assertEquals($compiledCss, $expectedCss);
    }
}