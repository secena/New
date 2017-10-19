<?php

/**
 * Test: Nette\Http\Response::setCookie().
 */

<<<<<<< HEAD
declare(strict_types=1);

=======
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
use Nette\Http;
use Tester\Assert;


require __DIR__ . '/../bootstrap.php';

if (PHP_SAPI === 'cli') {
	Tester\Environment::skip('Cookies are not available in CLI');
}


$old = headers_list();
$response = new Http\Response;


$response->setCookie('test', 'value', 0);
<<<<<<< HEAD
$headers = array_values(array_diff(headers_list(), $old, ['Set-Cookie:']));
Assert::same([
	'Set-Cookie: test=value; path=/; HttpOnly',
], $headers);


$response->setCookie('test', 'newvalue', 0);
$headers = array_values(array_diff(headers_list(), $old, ['Set-Cookie:']));
Assert::same([
	'Set-Cookie: test=newvalue; path=/; HttpOnly',
], $headers);


$response->setCookie('test', 'newvalue', 0, null, null, null, null, 'Lax');
$headers = array_values(array_diff(headers_list(), $old, ['Set-Cookie:']));
Assert::same([
	'Set-Cookie: test=newvalue; path=/; SameSite=Lax; HttpOnly',
], $headers);
=======
$headers = array_values(array_diff(headers_list(), $old, array('Set-Cookie:')));
$headers = str_replace('HttpOnly', 'httponly', $headers);
Assert::same(array(
	'Set-Cookie: test=value; path=/; httponly',
), $headers);


$response->setCookie('test', 'newvalue', 0);
$headers = array_values(array_diff(headers_list(), $old, array('Set-Cookie:')));
$headers = str_replace('HttpOnly', 'httponly', $headers);
Assert::same(array(
	'Set-Cookie: test=newvalue; path=/; httponly',
), $headers);
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
