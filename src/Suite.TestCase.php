<?php

namespace TheByteBar\FluxTest;

use \TheByteBar\FluxTest\TestCase;
use \TheByteBar\FluxTest\Suite;

class SuiteTestCase extends TestCase
{

    /**
     * The class we are testing
     * @var TheByteBar\FluxTest\Suite
     */
    private $suite;

    public function beforeEach()
    {
        $this->suite = new SuiteMock(__DIR__ . '/.', '.TestCase.php');
    }

    public function testConstructor()
    {
        $this->should('Return an instance object of the Suite object without throwing an exception.');
        $this->assert($this->suite instanceof Suite);
    }

}

/**
 * Mocking classes
 */
class SuiteMock extends Suite
{
    /**
     * The logs being output
     *
     * @var string
     */
    public static $logs;

    public function __construct($dir, $fireExt)
    {
        parent::__construct($dir, $fireExt);
        self::$logs = '';
    }

    public static function log($text)
    {
        self::$logs .= $text;
    }
}

// {C} thebytebar.com
