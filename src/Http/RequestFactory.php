<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */

declare(strict_types=1);

namespace Nette\Http;

use Nette;
use Nette\Utils\Strings;


/**
 * Current HTTP request factory.
 */
class RequestFactory
{
	use Nette\SmartObject;

	/** @internal */
<<<<<<< HEAD
	private const CHARS = '\x09\x0A\x0D\x20-\x7E\xA0-\x{10FFFF}';
=======
	const CHARS = '\x09\x0A\x0D\x20-\x7E\xA0-\x{10FFFF}';
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1

	/** @var array */
	public $urlFilters = [
		'path' => ['#/{2,}#' => '/'], // '%20' => ''
		'url' => [], // '#[.,)]\z#' => ''
	];

	/** @var bool */
	private $binary = false;

	/** @var array */
	private $proxies = [];


	/**
	 * @return static
	 */
	public function setBinary(bool $binary = true)
	{
		$this->binary = $binary;
		return $this;
	}


	/**
	 * @param  array|string
	 * @return static
	 */
	public function setProxy($proxy)
	{
		$this->proxies = (array) $proxy;
		return $this;
	}


	/**
	 * Creates current HttpRequest object.
	 */
	public function createHttpRequest(): Request
	{
		// DETECTS URI, base path and script path of the request.
		$url = new UrlScript;
		$url->setScheme(!empty($_SERVER['HTTPS']) && strcasecmp($_SERVER['HTTPS'], 'off') ? 'https' : 'http');
<<<<<<< HEAD
		$url->setUser($_SERVER['PHP_AUTH_USER'] ?? '');
		$url->setPassword($_SERVER['PHP_AUTH_PW'] ?? '');
=======
		$url->setUser(isset($_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER'] : '');
		$url->setPassword(isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : '');
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1

		// host & port
		if ((isset($_SERVER[$tmp = 'HTTP_HOST']) || isset($_SERVER[$tmp = 'SERVER_NAME']))
			&& preg_match('#^([a-z0-9_.-]+|\[[a-f0-9:]+\])(:\d+)?\z#i', $_SERVER[$tmp], $pair)
		) {
			$url->setHost(strtolower($pair[1]));
			if (isset($pair[2])) {
<<<<<<< HEAD
				$url->setPort((int) substr($pair[2], 1));
			} elseif (isset($_SERVER['SERVER_PORT'])) {
				$url->setPort((int) $_SERVER['SERVER_PORT']);
=======
				$url->setPort(substr($pair[2], 1));
			} elseif (isset($_SERVER['SERVER_PORT'])) {
				$url->setPort($_SERVER['SERVER_PORT']);
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
			}
		}

		// path & query
		$requestUrl = $_SERVER['REQUEST_URI'] ?? '/';
		$requestUrl = preg_replace('#^\w++://[^/]++#', '', $requestUrl);
		$requestUrl = Strings::replace($requestUrl, $this->urlFilters['url']);
		$tmp = explode('?', $requestUrl, 2);
<<<<<<< HEAD
		$path = Url::unescape($tmp[0], '%/?#');
		$path = Strings::fixEncoding(Strings::replace($path, $this->urlFilters['path']));
		$url->setPath($path);
		$url->setQuery($tmp[1] ?? '');

		// detect script path
		$lpath = strtolower($path);
		$script = isset($_SERVER['SCRIPT_NAME']) ? strtolower($_SERVER['SCRIPT_NAME']) : '';
		if ($lpath !== $script) {
			$max = min(strlen($lpath), strlen($script));
			for ($i = 0; $i < $max && $lpath[$i] === $script[$i]; $i++);
			$path = $i ? substr($path, 0, strrpos($path, '/', $i - strlen($path) - 1) + 1) : '/';
=======
		$url->setPath(Strings::replace($tmp[0], $this->urlFilters['path']));
		$url->setQuery(isset($tmp[1]) ? $tmp[1] : '');

		// normalized url
		$url->canonicalize();
		$url->setPath(Strings::fixEncoding($url->getPath()));

		// detect script path
		if (isset($_SERVER['SCRIPT_NAME'])) {
			$script = $_SERVER['SCRIPT_NAME'];
		} elseif (isset($_SERVER['DOCUMENT_ROOT'], $_SERVER['SCRIPT_FILENAME'])
			&& strncmp($_SERVER['DOCUMENT_ROOT'], $_SERVER['SCRIPT_FILENAME'], strlen($_SERVER['DOCUMENT_ROOT'])) === 0
		) {
			$script = '/' . ltrim(strtr(substr($_SERVER['SCRIPT_FILENAME'], strlen($_SERVER['DOCUMENT_ROOT'])), '\\', '/'), '/');
		} else {
			$script = '/';
		}

		$path = strtolower($url->getPath()) . '/';
		$script = strtolower($script) . '/';
		$max = min(strlen($path), strlen($script));
		for ($i = 0; $i < $max; $i++) {
			if ($path[$i] !== $script[$i]) {
				break;
			} elseif ($path[$i] === '/') {
				$url->setScriptPath(substr($url->getPath(), 0, $i + 1));
			}
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
		}
		$url->setScriptPath($path);

		// GET, POST, COOKIE
<<<<<<< HEAD
		$useFilter = (!in_array(ini_get('filter.default'), ['', 'unsafe_raw'], true) || ini_get('filter.default_flags'));
=======
		$useFilter = (!in_array(ini_get('filter.default'), array('', 'unsafe_raw')) || ini_get('filter.default_flags'));

		parse_str($url->getQuery(), $query);
		if (!$query) {
			$query = $useFilter ? filter_input_array(INPUT_GET, FILTER_UNSAFE_RAW) : (empty($_GET) ? array() : $_GET);
		}
		$post = $useFilter ? filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW) : (empty($_POST) ? array() : $_POST);
		$cookies = $useFilter ? filter_input_array(INPUT_COOKIE, FILTER_UNSAFE_RAW) : (empty($_COOKIE) ? array() : $_COOKIE);
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1

		$query = $url->getQueryParameters();
		$post = $useFilter ? filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW) : (empty($_POST) ? [] : $_POST);
		$cookies = $useFilter ? filter_input_array(INPUT_COOKIE, FILTER_UNSAFE_RAW) : (empty($_COOKIE) ? [] : $_COOKIE);

<<<<<<< HEAD
		// remove invalid characters
		$reChars = '#^[' . self::CHARS . ']*+\z#u';
		if (!$this->binary) {
			$list = [&$query, &$post, &$cookies];
			foreach ($list as $key => &$val) {
				foreach ($val as $k => $v) {
					if (is_string($k) && (!preg_match($reChars, $k) || preg_last_error())) {
						unset($list[$key][$k]);
=======
		// remove fucking quotes, control characters and check encoding
		$reChars = '#^[' . self::CHARS . ']*+\z#u';
		if ($gpc || !$this->binary) {
			$list = array(& $query, & $post, & $cookies);
			while (list($key, $val) = each($list)) {
				foreach ($val as $k => $v) {
					unset($list[$key][$k]);

					if ($gpc) {
						$k = stripslashes($k);
					}

					if (!$this->binary && is_string($k) && (!preg_match($reChars, $k) || preg_last_error())) {
						// invalid key -> ignore
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1

					} elseif (is_array($v)) {
						$list[$key][$k] = $v;
						$list[] = &$list[$key][$k];

					} else {
<<<<<<< HEAD
						$list[$key][$k] = (string) preg_replace('#[^' . self::CHARS . ']+#u', '', $v);
=======
						if ($gpc && !$useFilter) {
							$v = stripSlashes($v);
						}
						if (!$this->binary) {
							$v = (string) preg_replace('#[^' . self::CHARS . ']+#u', '', $v);
						}
						$list[$key][$k] = $v;
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
					}
				}
			}
			unset($list, $key, $val, $k, $v);
		}
		$url->setQuery($query);


		// FILES and create FileUpload objects
		$files = [];
		$list = [];
		if (!empty($_FILES)) {
			foreach ($_FILES as $k => $v) {
<<<<<<< HEAD
				if (!is_array($v) || !isset($v['name'], $v['type'], $v['size'], $v['tmp_name'], $v['error'])
					|| (!$this->binary && is_string($k) && (!preg_match($reChars, $k) || preg_last_error()))
				) {
=======
				if (!$this->binary && is_string($k) && (!preg_match($reChars, $k) || preg_last_error())) {
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
					continue;
				}
				$v['@'] = &$files[$k];
				$list[] = $v;
			}
		}

		foreach ($list as &$v) {
			if (!isset($v['name'])) {
				continue;

			} elseif (!is_array($v['name'])) {
<<<<<<< HEAD
=======
				if ($gpc) {
					$v['name'] = stripSlashes($v['name']);
				}
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
				if (!$this->binary && (!preg_match($reChars, $v['name']) || preg_last_error())) {
					$v['name'] = '';
				}
				if ($v['error'] !== UPLOAD_ERR_NO_FILE) {
					$v['@'] = new FileUpload($v);
				}
				continue;
			}

			foreach ($v['name'] as $k => $foo) {
				if (!$this->binary && is_string($k) && (!preg_match($reChars, $k) || preg_last_error())) {
					continue;
				}
				$list[] = [
					'name' => $v['name'][$k],
					'type' => $v['type'][$k],
					'size' => $v['size'][$k],
					'tmp_name' => $v['tmp_name'][$k],
					'error' => $v['error'][$k],
					'@' => &$v['@'][$k],
				];
			}
		}


		// HEADERS
		if (function_exists('apache_request_headers')) {
			$headers = apache_request_headers();
		} else {
			$headers = [];
			foreach ($_SERVER as $k => $v) {
				if (strncmp($k, 'HTTP_', 5) == 0) {
					$k = substr($k, 5);
				} elseif (strncmp($k, 'CONTENT_', 8)) {
					continue;
				}
<<<<<<< HEAD
				$headers[strtr($k, '_', '-')] = $v;
=======
				$headers[ strtr($k, '_', '-') ] = $v;
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
			}
		}

		$remoteAddr = !empty($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null;
		$remoteHost = !empty($_SERVER['REMOTE_HOST']) ? $_SERVER['REMOTE_HOST'] : null;

		// use real client address and host if trusted proxy is used
		$usingTrustedProxy = $remoteAddr && array_filter($this->proxies, function ($proxy) use ($remoteAddr) {
			return Helpers::ipMatch($remoteAddr, $proxy);
		});
		if ($usingTrustedProxy) {
			if (!empty($_SERVER['HTTP_FORWARDED'])) {
				$forwardParams = preg_split('/[,;]/', $_SERVER['HTTP_FORWARDED']);
				foreach ($forwardParams as $forwardParam) {
					[$key, $value] = explode('=', $forwardParam, 2) + [1 => null];
					$proxyParams[strtolower(trim($key))][] = trim($value, " \t\"");
				}

				if (isset($proxyParams['for'])) {
					$address = $proxyParams['for'][0];
					if (strpos($address, '[') === false) { //IPv4
						$remoteAddr = explode(':', $address)[0];
					} else { //IPv6
						$remoteAddr = substr($address, 1, strpos($address, ']') - 1);
					}
				}

<<<<<<< HEAD
				if (isset($proxyParams['host']) && count($proxyParams['host']) === 1) {
					$host = $proxyParams['host'][0];
					$startingDelimiterPosition = strpos($host, '[');
					if ($startingDelimiterPosition === false) { //IPv4
						$remoteHostArr = explode(':', $host);
						$remoteHost = $remoteHostArr[0];
						if (isset($remoteHostArr[1])) {
							$url->setPort((int) $remoteHostArr[1]);
						}
					} else { //IPv6
						$endingDelimiterPosition = strpos($host, ']');
						$remoteHost = substr($host, strpos($host, '[') + 1, $endingDelimiterPosition - 1);
						$remoteHostArr = explode(':', substr($host, $endingDelimiterPosition));
						if (isset($remoteHostArr[1])) {
							$url->setPort((int) $remoteHostArr[1]);
						}
					}
				}

				$scheme = (isset($proxyParams['proto']) && count($proxyParams['proto']) === 1) ? $proxyParams['proto'][0] : 'http';
				$url->setScheme(strcasecmp($scheme, 'https') === 0 ? 'https' : 'http');
			} else {
				if (!empty($_SERVER['HTTP_X_FORWARDED_PROTO'])) {
					$url->setScheme(strcasecmp($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') === 0 ? 'https' : 'http');
					$url->setPort($url->getScheme() === 'https' ? 443 : 80);
				}

				if (!empty($_SERVER['HTTP_X_FORWARDED_PORT'])) {
					$url->setPort((int) $_SERVER['HTTP_X_FORWARDED_PORT']);
				}

				if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
					$xForwardedForWithoutProxies = array_filter(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']), function ($ip) {
						return !array_filter($this->proxies, function ($proxy) use ($ip) {
							return filter_var(trim($ip), FILTER_VALIDATE_IP) !== false && Helpers::ipMatch(trim($ip), $proxy);
						});
					});
					$remoteAddr = trim(end($xForwardedForWithoutProxies));
					$xForwardedForRealIpKey = key($xForwardedForWithoutProxies);
				}

				if (isset($xForwardedForRealIpKey) && !empty($_SERVER['HTTP_X_FORWARDED_HOST'])) {
=======
		// proxy
		foreach ($this->proxies as $proxy) {
			if (Helpers::ipMatch($remoteAddr, $proxy) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$proxies = $this->proxies;
				$xForwardedForWithoutProxies = array_filter(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']), function ($ip) use ($proxies) {
					return !array_filter($proxies, function ($proxy) use ($ip) {
						return Helpers::ipMatch(trim($ip), $proxy);
					});
				});
				$remoteAddr = trim(end($xForwardedForWithoutProxies));

				if (!empty($_SERVER['HTTP_X_FORWARDED_HOST'])) {
					$xForwardedForRealIpKey = key($xForwardedForWithoutProxies);
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
					$xForwardedHost = explode(',', $_SERVER['HTTP_X_FORWARDED_HOST']);
					if (isset($xForwardedHost[$xForwardedForRealIpKey])) {
						$remoteHost = trim($xForwardedHost[$xForwardedForRealIpKey]);
					}
				}
			}
		}

		// method, eg. GET, PUT, ...
		$method = $_SERVER['REQUEST_METHOD'] ?? null;
		if ($method === 'POST' && isset($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'])
			&& preg_match('#^[A-Z]+\z#', $_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'])
		) {
			$method = $_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'];
		}

		// raw body
		$rawBodyCallback = function () {
			return file_get_contents('php://input');
		};

		return new Request($url, null, $post, $files, $cookies, $headers, $method, $remoteAddr, $remoteHost, $rawBodyCallback);
	}
}
