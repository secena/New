<?php

/**
 * Test: Nette\Http\Session error in session_start.
 */

<<<<<<< HEAD
declare(strict_types=1);

use Nette\Http\Session;
=======
use Nette\Http\Session;
use Nette\Http\SessionSection;
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
use Tester\Assert;


require __DIR__ . '/../bootstrap.php';


$_COOKIE['PHPSESSID'] = '#';


$session = new Session(new Nette\Http\Request(new Nette\Http\UrlScript), new Nette\Http\Response);

$session->start();

Assert::match('%[\w]+%', $session->getId());
