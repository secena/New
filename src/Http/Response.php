<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */

declare(strict_types=1);

namespace Nette\Http;

use Nette;
use Nette\Utils\DateTime;


/**
 * HttpResponse class.
 *
<<<<<<< HEAD
 * @property-read array $headers
=======
 * @author     David Grudl
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
 */
final class Response implements IResponse
{
	use Nette\SmartObject;

	/** @var string The domain in which the cookie will be available */
	public $cookieDomain = '';

	/** @var string The path in which the cookie will be available */
	public $cookiePath = '/';

	/** @var bool Whether the cookie is available only through HTTPS */
	public $cookieSecure = false;

	/** @var bool Whether the cookie is hidden from client-side */
	public $cookieHttpOnly = true;

	/** @var bool Whether warn on possible problem with data in output buffer */
	public $warnOnBuffer = true;

	/** @var bool  Send invisible garbage for IE 6? */
	private static $fixIE = true;

	/** @var bool Whether warn on possible problem with data in output buffer */
	public $warnOnBuffer = TRUE;

	/** @var int HTTP response code */
	private $code = self::S200_OK;


	public function __construct()
	{
<<<<<<< HEAD
		if (is_int($code = http_response_code())) {
			$this->code = $code;
=======
		if (PHP_VERSION_ID >= 50400) {
			if (is_int($code = http_response_code())) {
				$this->code = $code;
			}
		}

		if (PHP_VERSION_ID >= 50401) { // PHP bug #61106
			header_register_callback($this->removeDuplicateCookies); // requires closure due PHP bug #66375
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
		}
	}


	/**
	 * Sets HTTP response code.
	 * @return static
	 * @throws Nette\InvalidArgumentException  if code is invalid
	 * @throws Nette\InvalidStateException  if HTTP headers have been sent
	 */
	public function setCode(int $code, string $reason = null)
	{
		if ($code < 100 || $code > 599) {
			throw new Nette\InvalidArgumentException("Bad HTTP response '$code'.");
		}
		self::checkHeaders();
		$this->code = $code;

		static $hasReason = [ // hardcoded in PHP
			100, 101,
			200, 201, 202, 203, 204, 205, 206,
			300, 301, 302, 303, 304, 305, 307, 308,
			400, 401, 402, 403, 404, 405, 406, 407, 408, 409, 410, 411, 412, 413, 414, 415, 416, 417, 426, 428, 429, 431,
			500, 501, 502, 503, 504, 505, 506, 511,
		];
		if ($reason || !in_array($code, $hasReason, true)) {
			$protocol = $_SERVER['SERVER_PROTOCOL'] ?? 'HTTP/1.1';
			header("$protocol $code " . ($reason ?: 'Unknown status'));
		} else {
			http_response_code($code);
		}
		return $this;
	}


	/**
	 * Returns HTTP response code.
	 */
	public function getCode(): int
	{
		return $this->code;
	}


	/**
	 * Sends a HTTP header and replaces a previous one.
	 * @return static
	 * @throws Nette\InvalidStateException  if HTTP headers have been sent
	 */
	public function setHeader(string $name, ?string $value)
	{
		self::checkHeaders();
		if ($value === null) {
			header_remove($name);
		} elseif (strcasecmp($name, 'Content-Length') === 0 && ini_get('zlib.output_compression')) {
			// ignore, PHP bug #44164
		} else {
			header($name . ': ' . $value, true, $this->code);
		}
		return $this;
	}


	/**
	 * Adds HTTP header.
	 * @return static
	 * @throws Nette\InvalidStateException  if HTTP headers have been sent
	 */
	public function addHeader(string $name, string $value)
	{
		self::checkHeaders();
		header($name . ': ' . $value, false, $this->code);
		return $this;
	}


	/**
	 * Sends a Content-type HTTP header.
	 * @return static
	 * @throws Nette\InvalidStateException  if HTTP headers have been sent
	 */
	public function setContentType(string $type, string $charset = null)
	{
		$this->setHeader('Content-Type', $type . ($charset ? '; charset=' . $charset : ''));
		return $this;
	}


	/**
	 * Redirects to a new URL. Note: call exit() after it.
	 * @throws Nette\InvalidStateException  if HTTP headers have been sent
	 */
	public function redirect(string $url, int $code = self::S302_FOUND): void
	{
		$this->setCode($code);
		$this->setHeader('Location', $url);
		if (preg_match('#^https?:|^\s*+[a-z0-9+.-]*+[^:]#i', $url)) {
<<<<<<< HEAD
			$escapedUrl = htmlspecialchars($url, ENT_IGNORE | ENT_QUOTES, 'UTF-8');
=======
			$escapedUrl = htmlSpecialChars($url, ENT_IGNORE | ENT_QUOTES, 'UTF-8');
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
			echo "<h1>Redirect</h1>\n\n<p><a href=\"$escapedUrl\">Please click here to continue</a>.</p>";
		}
	}


	/**
	 * Sets the number of seconds before a page cached on a browser expires.
<<<<<<< HEAD
	 * @param  string|null like '20 minutes', null means "must-revalidate"
	 * @return static
=======
	 * @param  string|int|\DateTime  time, value 0 means "until the browser is closed"
	 * @return self
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
	 * @throws Nette\InvalidStateException  if HTTP headers have been sent
	 */
	public function setExpiration($time)
	{
		$this->setHeader('Pragma', null);
		if (!$time) { // no cache
			$this->setHeader('Cache-Control', 's-maxage=0, max-age=0, must-revalidate');
			$this->setHeader('Expires', 'Mon, 23 Jan 1978 10:00:00 GMT');
			return $this;
		}

		$time = DateTime::from($time);
		$this->setHeader('Cache-Control', 'max-age=' . ($time->format('U') - time()));
		$this->setHeader('Expires', Helpers::formatDate($time));
		return $this;
	}


	/**
	 * Checks if headers have been sent.
	 */
	public function isSent(): bool
	{
		return headers_sent();
	}


	/**
	 * Returns value of an HTTP header.
<<<<<<< HEAD
=======
	 * @param  string
	 * @param  mixed
	 * @return mixed
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
	 */
	public function getHeader(string $header): ?string
	{
		if (func_num_args() > 1) {
			trigger_error(__METHOD__ . '() parameter $default is deprecated, use operator ??', E_USER_DEPRECATED);
		}
		$header .= ':';
		$len = strlen($header);
		foreach (headers_list() as $item) {
			if (strncasecmp($item, $header, $len) === 0) {
				return ltrim(substr($item, $len));
			}
		}
		return null;
	}


	/**
<<<<<<< HEAD
	 * Returns a associative array of headers to sent.
=======
	 * Returns a list of headers to sent.
	 * @return array (name => value)
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
	 */
	public function getHeaders(): array
	{
		$headers = [];
		foreach (headers_list() as $header) {
			$a = strpos($header, ':');
			$headers[substr($header, 0, $a)] = (string) substr($header, $a + 2);
		}
		return $headers;
	}


	public function __destruct()
	{
		if (self::$fixIE && isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE ') !== false
			&& in_array($this->code, [400, 403, 404, 405, 406, 408, 409, 410, 500, 501, 505], true)
			&& preg_match('#^text/html(?:;|$)#', $this->getHeader('Content-Type'))
		) {
			echo Nette\Utils\Random::generate(2000, " \t\r\n"); // sends invisible garbage for IE
			self::$fixIE = false;
		}
	}


	/**
	 * Sends a cookie.
<<<<<<< HEAD
	 * @param  string|int|\DateTimeInterface $time  expiration time, value 0 means "until the browser is closed"
	 * @return static
=======
	 * @param  string name of the cookie
	 * @param  string value
	 * @param  string|int|\DateTime  expiration time, value 0 means "until the browser is closed"
	 * @param  string
	 * @param  string
	 * @param  bool
	 * @param  bool
	 * @return self
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
	 * @throws Nette\InvalidStateException  if HTTP headers have been sent
	 */
	public function setCookie(string $name, string $value, $time, string $path = null, string $domain = null, bool $secure = null, bool $httpOnly = null, string $sameSite = null)
	{
		$sameSite = $sameSite ? "; SameSite=$sameSite" : '';
		self::checkHeaders();
		setcookie(
			$name,
			$value,
			$time ? (int) DateTime::from($time)->format('U') : 0,
			($path === null ? $this->cookiePath : $path) . $sameSite,
			$domain === null ? $this->cookieDomain : $domain,
			$secure === null ? $this->cookieSecure : $secure,
			$httpOnly === null ? $this->cookieHttpOnly : $httpOnly
		);
		Helpers::removeDuplicateCookies();
		return $this;
	}


	/**
	 * Deletes a cookie.
	 * @throws Nette\InvalidStateException  if HTTP headers have been sent
	 */
	public function deleteCookie(string $name, string $path = null, string $domain = null, bool $secure = null): void
	{
		$this->setCookie($name, '', 0, $path, $domain, $secure);
	}


<<<<<<< HEAD
	private function checkHeaders(): void
=======
	/**
	 * Removes duplicate cookies from response.
	 * @return void
	 * @internal
	 */
	public function removeDuplicateCookies()
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
	{
		if (PHP_SAPI === 'cli') {
		} elseif (headers_sent($file, $line)) {
			throw new Nette\InvalidStateException('Cannot send header after HTTP headers have been sent' . ($file ? " (output started at $file:$line)." : '.'));

<<<<<<< HEAD
		} elseif ($this->warnOnBuffer && ob_get_length() && !array_filter(ob_get_status(true), function ($i) { return !$i['chunk_size']; })) {
			trigger_error('Possible problem: you are sending a HTTP header while already having some data in output buffer. Try Tracy\OutputDebugger or start session earlier.');
=======
		} elseif ($this->warnOnBuffer && ob_get_length() && !array_filter(ob_get_status(TRUE), function ($i) { return !$i['chunk_size']; })) {
			trigger_error('Possible problem: you are sending a HTTP header while already having some data in output buffer. Try Tracy\OutputDebugger or start session earlier.', E_USER_NOTICE);
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
		}
	}
}
