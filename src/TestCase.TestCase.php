<?php

namespace TheByteBar\FluxTest;

use \TheByteBar\FluxTest\TestCase;
use \TheByteBar\FluxTestException;
use \PDO;

class TestCaseTestCase extends TestCase {

    /**
     * The class we are testing
     * @var TheByteBar\FluxTest\TestCase
     */
    private $testCase;

    public function beforeEach() {
        $this->testCase = $this->getMockObject(TestCaseMock::class);
    }

    public function testConstructor() {
        $this->should('Return an instance object of the TestCase object without throwing an exception.');
        $this->assert($this->testCase instanceof TestCase);
    }

    public function testGetMock() {
        $this->should('Throw an exception if the class we are trying to mock does not exists');
        try {
            $mock = $this->testCase->getMockObject('Mock');
            $this->assert(false);
        } catch (TestException $e) {
            $this->assert(true);
        }

        $this->should('Throw an exception if you try to override a protected method.');
        try {
            $mock = $this->testCase->getMockObject(TestCaseMock::class, [
                'myProtectedMethod' => true
            ]);
            $this->assert(false);
        } catch (TestException $e) {
            $this->assert(true);
        }

        $this->should('Throw an exception if you try to override a private method.');
        try {
            $mock = $this->testCase->getMockObject(TestCaseMock::class, [
                'myPrivateMethod' => true
            ]);
            $this->assert(false);
        } catch (TestException $e) {
            $this->assert(true);
        }

        $this->should('Throw an exception if you try to override a final method.');
        try {
            $mock = $this->testCase->getMockObject(TestCaseMock::class, [
                'myFinalPublicFunction' => true
            ]);
            $this->assert(false);
        } catch (TestException $e) {
            $this->assert(true);
        }

        $this->should('Throw an exception if you try to override a static method.');
        try {
            $mock = $this->testCase->getMockObject(TestCaseMock::class, [
                'myStaticPublicMethod' => true
            ]);
            $this->assert(false);
        } catch (TestException $e) {
            $this->assert(true);
        }

        $this->should('Successfully return a mock object with an overriden public method.');
        $mock = $this->testCase->getMockObject(TestCaseMock::class, [
            'myPublicMethod' => true
        ]);
        $this->assert($mock->myPublicMethod());

        $this->should('Return an extended object of the same type.');
        $mock = $this->testCase->getMockObject(PDO::class);
        $this->assert($mock instanceof PDO);
    }

}

/**
 * Mock class
 */
class TestCaseMock extends TestCase {

    public function myPublicMethod() {
        return false;
    }

    static public function myStaticPublicMethod() {
        return false;
    }

    protected function myProtectedMethod() {
        return false;
    }

    private function myPrivateMethod() {
        return false;
    }

    final public function myFinalPublicFunction(){
        return false;
    }

}
