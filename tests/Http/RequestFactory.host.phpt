<?php

/**
 * Test: Nette\Http\RequestFactory and host.
 */

<<<<<<< HEAD
declare(strict_types=1);

=======
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
use Nette\Http\RequestFactory;
use Tester\Assert;


require __DIR__ . '/../bootstrap.php';


$_SERVER = [
	'HTTP_HOST' => 'localhost',
];
$factory = new RequestFactory;
Assert::same('http://localhost/', (string) $factory->createHttpRequest()->getUrl());


$_SERVER = [
	'HTTP_HOST' => 'www-x.nette.org',
];
$factory = new RequestFactory;
Assert::same('http://www-x.nette.org/', (string) $factory->createHttpRequest()->getUrl());


$_SERVER = [
	'HTTP_HOST' => '192.168.0.1:8080',
];
$factory = new RequestFactory;
Assert::same('http://192.168.0.1:8080/', (string) $factory->createHttpRequest()->getUrl());


$_SERVER = [
	'HTTP_HOST' => '[::1aF]:8080',
];
$factory = new RequestFactory;
Assert::same('http://[::1af]:8080/', (string) $factory->createHttpRequest()->getUrl());


$_SERVER = [
	'HTTP_HOST' => "a.cz\n",
];
$factory = new RequestFactory;
Assert::same('http:///', (string) $factory->createHttpRequest()->getUrl());


$_SERVER = [
	'HTTP_HOST' => 'AB',
];
$factory = new RequestFactory;
Assert::same('http://ab/', (string) $factory->createHttpRequest()->getUrl());
