<?php

/**
 * Test: Nette\Http\Url file://
 */

<<<<<<< HEAD
declare(strict_types=1);

=======
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
use Nette\Http\Url;
use Tester\Assert;


require __DIR__ . '/../bootstrap.php';


test(function () {
	$url = new Url('file://localhost/D:/dokumentace/rfc3986.txt');
<<<<<<< HEAD
	Assert::same('file://localhost/D:/dokumentace/rfc3986.txt', (string) $url);
	Assert::same('file', $url->scheme);
	Assert::same('', $url->user);
	Assert::same('', $url->password);
	Assert::same('localhost', $url->host);
	Assert::null($url->port);
	Assert::same('/D:/dokumentace/rfc3986.txt', $url->path);
	Assert::same('', $url->query);
	Assert::same('', $url->fragment);
=======
	Assert::same('file://localhost/D:/dokumentace/rfc3986.txt',  (string) $url);
	Assert::same('file',  $url->scheme);
	Assert::same('',  $url->user);
	Assert::same('',  $url->password);
	Assert::same('localhost',  $url->host);
	Assert::null($url->port);
	Assert::same('/D:/dokumentace/rfc3986.txt',  $url->path);
	Assert::same('',  $url->query);
	Assert::same('',  $url->fragment);
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
});


test(function () {
	$url = new Url('file:///D:/dokumentace/rfc3986.txt');
<<<<<<< HEAD
	Assert::same('file://D:/dokumentace/rfc3986.txt', (string) $url);
	Assert::same('file', $url->scheme);
	Assert::same('', $url->user);
	Assert::same('', $url->password);
	Assert::same('', $url->host);
	Assert::null($url->port);
	Assert::same('D:/dokumentace/rfc3986.txt', $url->path);
	Assert::same('', $url->query);
	Assert::same('', $url->fragment);
=======
	Assert::same('file://D:/dokumentace/rfc3986.txt',  (string) $url);
	Assert::same('file',  $url->scheme);
	Assert::same('',  $url->user);
	Assert::same('',  $url->password);
	Assert::same('',  $url->host);
	Assert::null($url->port);
	Assert::same('D:/dokumentace/rfc3986.txt',  $url->path);
	Assert::same('',  $url->query);
	Assert::same('',  $url->fragment);
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
});
