<?php

/**
 * Test: Nette\Http\Session storage.
<<<<<<< HEAD
 */

declare(strict_types=1);

=======
 * @phpversion 5.4
 */

use Nette\Object;
use Nette\Http\Session;
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
use Tester\Assert;


require __DIR__ . '/../bootstrap.php';


class MySessionStorage implements SessionHandlerInterface
{
	private $path;


	public function open($savePath, $sessionName)
	{
		$this->path = $savePath;
<<<<<<< HEAD
		return true;
=======
		return TRUE;
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
	}


	public function close()
	{
<<<<<<< HEAD
		return true;
=======
		return TRUE;
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
	}


	public function read($id)
	{
		return (string) @file_get_contents("$this->path/sess_$id");
	}


	public function write($id, $data)
	{
		return (bool) file_put_contents("$this->path/sess_$id", $data);
	}


	public function destroy($id)
	{
		return !is_file("$this->path/sess_$id") || @unlink("$this->path/sess_$id");
	}


	public function gc($maxlifetime)
	{
		foreach (glob("$this->path/sess_*") as $filename) {
			if (filemtime($filename) + $maxlifetime < time()) {
				unlink($filename);
			}
		}
		return true;
	}
}


$factory = new Nette\Http\RequestFactory;
$session = new Nette\Http\Session($factory->createHttpRequest(), new Nette\Http\Response);

$session->setHandler(new MySessionStorage);
$session->start();
$_COOKIE['PHPSESSID'] = $session->getId();

$namespace = $session->getSection('one');
$namespace->a = 'apple';
$session->close();
unset($_SESSION);

$session->start();
$namespace = $session->getSection('one');
Assert::same('apple', $namespace->a);
