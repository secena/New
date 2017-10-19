<?php

/**
 * Test: Nette\Http\Session handle storage exceptions.
<<<<<<< HEAD
 */

declare(strict_types=1);

use Nette\Http;
=======
 * @phpversion 5.4.11
 */

use Nette\Http;
use Nette\Http\Session;
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
use Tester\Assert;


require __DIR__ . '/../bootstrap.php';


class ThrowsOnReadHandler extends \SessionHandler
{
<<<<<<< HEAD
	public function open($save_path, $session_id)
	{
		return true; // never throw an exception from here, the universe might implode
=======

	public function open($save_path, $session_id)
	{
		return TRUE; // never throw an exception from here, the universe might implode
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
	}


	public function read($session_id)
	{
		throw new RuntimeException("Session can't be started for whatever reason!");
	}
<<<<<<< HEAD
=======

>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
}


$session = new Nette\Http\Session(new Http\Request(new Http\UrlScript('http://nette.org')), new Http\Response);
$session->setHandler(new ThrowsOnReadHandler);

Assert::exception(function () use ($session) {
	$session->start();
<<<<<<< HEAD
}, RuntimeException::class, 'Session can\'t be started for whatever reason!');

Assert::exception(function () use ($session) {
	$session->start();
}, RuntimeException::class, 'Session can\'t be started for whatever reason!');

$session->setHandler(new \SessionHandler);
=======
}, 'RuntimeException', 'Session can\'t be started for whatever reason!');

Assert::exception(function () use ($session) {
	$session->start();
}, 'RuntimeException', 'Session can\'t be started for whatever reason!');

$session->setHandler(new \SessionHandler());
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
$session->start();
