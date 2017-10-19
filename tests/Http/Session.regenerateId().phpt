<?php

/**
 * Test: Nette\Http\Session::regenerateId()
 */

<<<<<<< HEAD
declare(strict_types=1);

=======
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
use Nette\Http\Session;
use Tester\Assert;


require __DIR__ . '/../bootstrap.php';


$session = new Session(new Nette\Http\Request(new Nette\Http\UrlScript), new Nette\Http\Response);

$path = rtrim(ini_get('session.save_path'), '/\\') . '/sess_';

$session->start();
$oldId = $session->getId();
Assert::true(is_file($path . $oldId));
<<<<<<< HEAD
$ref = &$_SESSION['var'];
=======
$ref = & $_SESSION['var'];
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
$ref = 10;

$session->regenerateId();
$newId = $session->getId();
Assert::same($newId, $oldId); // new session is regenerated by $session->start()
Assert::true(is_file($path . $newId));

$ref = 20;
Assert::same(20, $_SESSION['var']);
