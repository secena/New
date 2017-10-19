<?php

/**
 * Test: Nette\Http\Session storage.
<<<<<<< HEAD
 */

declare(strict_types=1);

=======
 * @phpversion 5.4.11
 */

use Nette\Http\Session;
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
use Tester\Assert;


require __DIR__ . '/../bootstrap.php';

if (PHP_SAPI === 'cli') {
	Tester\Environment::skip('Default session handler is not available in CLI');
}


class MySessionStorageExtension extends \SessionHandler
{
}


$factory = new Nette\Http\RequestFactory;
$session = new Nette\Http\Session($factory->createHttpRequest(), new Nette\Http\Response);

<<<<<<< HEAD
$session->setOptions(['save_handler' => 'files']);
=======
$session->setOptions(array('save_handler' => 'files'));
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
$session->setHandler(new MySessionStorageExtension);
$session->start(); //and configure();
Assert::same('user', ini_get('session.save_handler'));
