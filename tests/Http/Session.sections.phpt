<?php

/**
 * Test: Nette\Http\Session sections.
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


ob_start();

$session = new Session(new Nette\Http\Request(new Nette\Http\UrlScript), new Nette\Http\Response);

<<<<<<< HEAD
Assert::false($session->hasSection('trees')); // hasSection() should have returned false for a section with no keys set

$section = $session->getSection('trees');
Assert::false($session->hasSection('trees')); // hasSection() should have returned false for a section with no keys set

$section->hello = 'world';
Assert::true($session->hasSection('trees')); // hasSection() should have returned true for a section with keys set

$section = $session->getSection('default');
Assert::type(Nette\Http\SessionSection::class, $section);
=======
Assert::false($session->hasSection('trees')); // hasSection() should have returned FALSE for a section with no keys set

$section = $session->getSection('trees');
Assert::false($session->hasSection('trees')); // hasSection() should have returned FALSE for a section with no keys set

$section->hello = 'world';
Assert::true($session->hasSection('trees')); // hasSection() should have returned TRUE for a section with keys set

$section = $session->getSection('default');
Assert::type('Nette\Http\SessionSection', $section);
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
