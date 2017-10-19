<?php

/**
 * Test: Nette\Http\Url malformed URI.
 */

<<<<<<< HEAD
declare(strict_types=1);

=======
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
use Nette\Http\Url;
use Tester\Assert;


require __DIR__ . '/../bootstrap.php';


Assert::exception(function () {
	$url = new Url('http:///');
}, InvalidArgumentException::class, "Malformed or unsupported URI 'http:///'.");
