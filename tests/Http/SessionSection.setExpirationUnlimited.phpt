<?php

/**
 * Test: Nette\Http\SessionSection::setExpiration()
 */

<<<<<<< HEAD
declare(strict_types=1);

=======
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
use Nette\Http\Session;
use Tester\Assert;


require __DIR__ . '/../bootstrap.php';


$session = new Session(new Nette\Http\Request(new Nette\Http\UrlScript), new Nette\Http\Response);
<<<<<<< HEAD
$session->setOptions(['gc_maxlifetime' => '0']); //memcache handler supports unlimited expiration
=======
$session->setOptions(array('gc_maxlifetime' => '0')); //memcache handler supports unlimited expiration
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1

//try to set section to shorter expiration
$namespace = $session->getSection('maxlifetime');
$namespace->setExpiration(100);

<<<<<<< HEAD
Assert::same(true, true); // fix Error: This test forgets to execute an assertion.
=======
Assert::same(TRUE, TRUE); // fix Error: This test forgets to execute an assertion.
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
