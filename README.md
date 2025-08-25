# FluxTest - PHP Test Automation

A Lightweight PHP Testing Framework

## Documentation

https://fluxtest.thebytebar.com

## Configure The Test Runner

FluxTest can be configured so that it can be ran from either directly the command line or from your composer run-scripts.

**Running directly from the command line:**

    php vendor/thebytebar/fluxtest/scripts/runner.php --dir=[directory] --ext=[fireExt]

The `runner.php` file is a script meant to bootstrap your test suite together to make it easier to configure your test runner. It accepts two parameters. `[directory]` is the directory you would like to scan to search for your test files. `[fileExt]` is the file extension FluxTest should look for when it is scanning for tests.

Example:

    php vendor/thebytebar/fluxtest/scripts/runner.php --dir=src --ext=.TestCase.php

In the example above, the test suite will search through your `src` directory for all files with the extension `.TestCase.php`.

**Running as a Composer Run-Script:**

To run FluxTest as a composer test script all you need to do is configure the run-script to run the `runner.php` script and point it to the directory you want and the file extension you want it to find. You will find run-script configurations in your `composer.json` file located at the configuration `scripts`.

    "scripts": {
        "test": "php vendor/thebytebar/fluxtest/scripts/runner.php --dir=/src --ext=.TestCase.php"
    }

Once you have it configured all you need to do is run the test script using Composer.

    composer test

## Creating Your First Test

To create your first test, you will need to start out by creating your test file. Your test file will consist of a class you create which will extend the class `\TheByteBar\FluxTest\TestCase`.

Example:

    use TheByteBar\FluxTest\TestCase;

    class MyTestCase extends TestCase
    {
        //my test suite logic
    }

Once you test suite is loaded and initialized, the FluxTest will iterate through all your methods that begin with the name `test` and run each one.

Example:

    public function testMyMethod()
    {
        //my test logic
    }

## Asserting

At some point, you will most likely want to assert something with your test method. Because you extended the `TheByteBar\FluxTest\TestCase` class, you have access to two methods called TheByteBar\FluxTest\TestCase::should($statement)` and `TheByteBar\FluxTest\TestCase::assert($true)`. The `should` method provides you a way to tell us what your assert is going to do. Think of it like "this test should...". The `assert` method evaluates the `$true` parameter to determine a pass or fail. `$true` must evaluate to a `true` boolean value.

Example:

    $this->should('Should be set to true.')
    // do some scaffolding to setup your test
    $this->assert(true);

## FluxTest Logging

You have the ability to log out information as your tests are running. `TheByteBar\FluxTest\Suite::log()` is a static method you can use to log out information as your test is running.
