<?php

/**
 * Test: Nette\Http\Request detectLanguage.
 */

<<<<<<< HEAD
declare(strict_types=1);

=======
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
use Nette\Http;
use Tester\Assert;


require __DIR__ . '/../bootstrap.php';


test(function () {
<<<<<<< HEAD
	$headers = ['Accept-Language' => 'en, cs'];
	$request = new Http\Request(new Http\UrlScript, null, null, null, null, $headers);

	Assert::same('en', $request->detectLanguage(['en', 'cs']));
	Assert::same('en', $request->detectLanguage(['cs', 'en']));
	Assert::null($request->detectLanguage(['xx']));
=======
	$headers = array('Accept-Language' => 'en, cs');
	$request = new Http\Request(new Http\UrlScript, NULL, NULL, NULL, NULL, $headers);

	Assert::same('en', $request->detectLanguage(array('en', 'cs')));
	Assert::same('en', $request->detectLanguage(array('cs', 'en')));
	Assert::null($request->detectLanguage(array('xx')));
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
});


test(function () {
<<<<<<< HEAD
	$headers = ['Accept-Language' => 'da, en-gb;q=0.8, en;q=0.7'];
	$request = new Http\Request(new Http\UrlScript, null, null, null, null, $headers);

	Assert::same('en-gb', $request->detectLanguage(['en', 'en-gb']));
	Assert::same('en', $request->detectLanguage(['en']));
=======
	$headers = array('Accept-Language' => 'da, en-gb;q=0.8, en;q=0.7');
	$request = new Http\Request(new Http\UrlScript, NULL, NULL, NULL, NULL, $headers);

	Assert::same('en-gb', $request->detectLanguage(array('en', 'en-gb')));
	Assert::same('en', $request->detectLanguage(array('en')));
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
});


test(function () {
<<<<<<< HEAD
	$headers = [];
	$request = new Http\Request(new Http\UrlScript, null, null, null, null, $headers);

	Assert::null($request->detectLanguage(['en']));
=======
	$headers = array();
	$request = new Http\Request(new Http\UrlScript, NULL, NULL, NULL, NULL, $headers);

	Assert::null($request->detectLanguage(array('en')));
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
});


test(function () {
<<<<<<< HEAD
	$headers = ['Accept-Language' => 'garbage'];
	$request = new Http\Request(new Http\UrlScript, null, null, null, null, $headers);

	Assert::null($request->detectLanguage(['en']));
=======
	$headers = array('Accept-Language' => 'garbage');
	$request = new Http\Request(new Http\UrlScript, NULL, NULL, NULL, NULL, $headers);

	Assert::null($request->detectLanguage(array('en')));
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
});
