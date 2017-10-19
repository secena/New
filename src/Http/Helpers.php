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
 * Rendering helpers for HTTP.
 */
final class Helpers
{
	use Nette\StaticClass;

	/**
	 * Returns HTTP valid date format.
	 * @param  string|int|\DateTimeInterface
	 */
	public static function formatDate($time): string
	{
		$time = DateTime::from($time)->setTimezone(new \DateTimeZone('GMT'));
		return $time->format('D, d M Y H:i:s \G\M\T');
	}


	/**
	 * Is IP address in CIDR block?
	 */
	public static function ipMatch($ip, $mask): bool
	{
<<<<<<< HEAD
		[$mask, $size] = explode('/', $mask . '/');
=======
		list($mask, $size) = explode('/', $mask . '/');
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
		$tmp = function ($n) { return sprintf('%032b', $n); };
		$ip = implode('', array_map($tmp, unpack('N*', inet_pton($ip))));
		$mask = implode('', array_map($tmp, unpack('N*', inet_pton($mask))));
		$max = strlen($ip);
<<<<<<< HEAD
		if (!$max || $max !== strlen($mask) || (int) $size < 0 || (int) $size > $max) {
			return false;
		}
		return strncmp($ip, $mask, $size === '' ? $max : (int) $size) === 0;
=======
		if (!$max || $max !== strlen($mask) || $size < 0 || $size > $max) {
			return FALSE;
		}
		return strncmp($ip, $mask, $size === '' ? $max : $size) === 0;
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
	}


	/**
	 * Removes duplicate cookies from response.
	 * @internal
	 */
	public static function removeDuplicateCookies(): void
	{
		if (headers_sent($file, $line) || ini_get('suhosin.cookie.encrypt')) {
			return;
		}

		$flatten = [];
		foreach (headers_list() as $header) {
			if (preg_match('#^Set-Cookie: .+?=#', $header, $m)) {
				$flatten[$m[0]] = $header;
				header_remove('Set-Cookie');
			}
		}
		foreach (array_values($flatten) as $key => $header) {
			header($header, $key === 0);
		}
	}
}
