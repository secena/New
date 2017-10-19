<?php

/**
 * Test: Nette\Http\SessionSection basic usage.
 */

<<<<<<< HEAD
declare(strict_types=1);

=======
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
use Nette\Http\Session;
use Tester\Assert;


require __DIR__ . '/../bootstrap.php';


$session = new Session(new Nette\Http\Request(new Nette\Http\UrlScript), new Nette\Http\Response);

$namespace = $session->getSection('one');
$namespace->a = 'apple';
$namespace->p = 'pear';
$namespace['o'] = 'orange';

foreach ($namespace as $key => $val) {
	$tmp[] = "$key=$val";
}
<<<<<<< HEAD
Assert::same([
	'a=apple',
	'p=pear',
	'o=orange',
], $tmp);


Assert::true(isset($namespace['p']));
Assert::true(isset($namespace->o));
Assert::false(isset($namespace->undefined));

unset($namespace['a'], $namespace->p, $namespace->o, $namespace->undef);


=======
Assert::same(array(
	'a=apple',
	'p=pear',
	'o=orange',
), $tmp);


Assert::true(isset($namespace['p']));
Assert::true(isset($namespace->o));
Assert::false(isset($namespace->undefined));
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1


Assert::same('', http_build_query($namespace->getIterator()));
