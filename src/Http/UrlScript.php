<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */

declare(strict_types=1);

<<<<<<< HEAD
namespace Nette\Http;

=======
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1

/**
 * Extended HTTP URL.
 *
 * <pre>
 * http://nette.org/admin/script.php/pathinfo/?name=param#fragment
 *                 \_______________/\________/
 *                        |              |
 *                   scriptPath       pathInfo
 * </pre>
 *
 * - scriptPath:  /admin/script.php (or simply /admin/ when script is directory index)
 * - pathInfo:    /pathinfo/ (additional path information)
 *
 * @property   string $scriptPath
 * @property-read string $pathInfo
 */
class UrlScript extends Url
{
	/** @var string */
	private $scriptPath;


	public function __construct($url = null, string $scriptPath = '')
	{
		parent::__construct($url);
		$this->setScriptPath($scriptPath);
	}


	/**
	 * Sets the script-path part of URI.
	 * @return static
	 */
	public function setScriptPath(string $value)
	{
		$this->scriptPath = $value;
		return $this;
	}


	/**
	 * Returns the script-path part of URI.
	 */
	public function getScriptPath(): string
	{
		return $this->scriptPath ?: $this->path;
	}


	/**
	 * Returns the base-path.
	 */
	public function getBasePath(): string
	{
<<<<<<< HEAD
		$pos = strrpos($this->getScriptPath(), '/');
		return $pos === false ? '' : substr($this->getPath(), 0, $pos + 1);
=======
		$pos = strrpos($this->scriptPath, '/');
		return $pos === FALSE ? '' : substr($this->getPath(), 0, $pos + 1);
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
	}


	/**
	 * Returns the additional path information.
	 */
	public function getPathInfo(): string
	{
<<<<<<< HEAD
		return (string) substr($this->getPath(), strlen($this->getScriptPath()));
=======
		return (string) substr($this->getPath(), strlen($this->scriptPath));
>>>>>>> 252926673fbd6de211a39a1f51e16bcfeefff1e1
	}
}
