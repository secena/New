<?php

/**
 * Test: Nette\Http\Session accepts cookie from Http\IRequest
 */

<<<<<<< HEAD
declare(strict_types=1);

=======
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
use Nette\Http;
use Nette\Http\Session;
use Tester\Assert;


require __DIR__ . '/../bootstrap.php';

<<<<<<< HEAD
$_COOKIE['PHPSESSID'] = $leet = md5('1337');

// create fake session
$cookies = ['PHPSESSID' => $sessionId = md5('1')];
file_put_contents(TEMP_DIR . '/sess_' . $sessionId, sprintf('__NF|a:2:{s:4:"Time";i:%s;s:4:"DATA";a:1:{s:4:"temp";a:1:{s:5:"value";s:3:"yes";}}}', time() - 1000));

$session = new Session(new Http\Request(new Http\UrlScript('http://nette.org'), null, [], [], $cookies), new Http\Response);

$session->start();
Assert::same($sessionId, $session->getId());
Assert::same(['PHPSESSID' => $leet], $_COOKIE);
=======
$_COOKIE['PHPSESSID'] = $leet = md5(1337);

// create fake session
$cookies = array('PHPSESSID' => $sessionId = md5(1), 'nette-browser' => $B = substr(md5(2), 0, 10));
file_put_contents(TEMP_DIR . '/sess_' . $sessionId, sprintf('__NF|a:3:{s:4:"Time";i:%s;s:1:"B";s:10:"%s";s:4:"DATA";a:1:{s:4:"temp";a:1:{s:5:"value";s:3:"yes";}}}', time() - 1000, $B));

$session = new Session(new Http\Request(new Http\UrlScript('http://nette.org'), NULL, array(), array(), $cookies), new Http\Response());

$session->start();
Assert::same($sessionId, $session->getId());
Assert::same(array('PHPSESSID' => $leet), $_COOKIE);
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1

Assert::same('yes', $session->getSection('temp')->value);
$session->close();

// session was not regenerated
Assert::true(file_exists(TEMP_DIR . '/sess_' . $sessionId));
Assert::count(1, glob(TEMP_DIR . '/sess_*'));
