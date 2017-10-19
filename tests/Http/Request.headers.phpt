<?php

/**
 * Test: Nette\Http\Request headers.
 */

<<<<<<< HEAD
declare(strict_types=1);

=======
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
use Nette\Http;
use Tester\Assert;


require __DIR__ . '/../bootstrap.php';


test(function () {
	$request = new Http\Request(new Http\UrlScript);
<<<<<<< HEAD
	Assert::same([], $request->getHeaders());
});

test(function () {
	$request = new Http\Request(new Http\UrlScript, null, null, null, null, []);
	Assert::same([], $request->getHeaders());
});

test(function () {
	$request = new Http\Request(new Http\UrlScript, null, null, null, null, [
		'one' => '1',
		'TWO' => '2',
		'X-Header' => 'X',
	]);

	Assert::same([
		'one' => '1',
		'two' => '2',
		'x-header' => 'X',
	], $request->getHeaders());
=======
	Assert::same(array(), $request->getHeaders());
});

test(function () {
	$request = new Http\Request(new Http\UrlScript, NULL, NULL, NULL, NULL, array());
	Assert::same(array(), $request->getHeaders());
});

test(function () {
	$request = new Http\Request(new Http\UrlScript, NULL, NULL, NULL, NULL, array(
		'one' => '1',
		'TWO' => '2',
		'X-Header' => 'X',
	));

	Assert::same(array(
		'one' => '1',
		'two' => '2',
		'x-header' => 'X',
	), $request->getHeaders());
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
	Assert::same('1', $request->getHeader('One'));
	Assert::same('2', $request->getHeader('Two'));
	Assert::same('X', $request->getHeader('X-Header'));
});
