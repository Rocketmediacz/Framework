<?php

/**
 * Copyright (c) 2014 David Zadražil (me@davidzadrazil.cz)
 *
 * For the full copyright and license information, please view the file license.txt that was distributed with this source code.
 */

namespace Scribe\Templating;

use Nette\Object;

/**
 * Class Helpers
 *
 * @author David Zadražil <me@davidzadrazil.cz>
 */
class Helpers extends Object
{

	/**
	 * @param $helper
	 *
	 * @return \Nette\Callback
	 */
	public function helperLoader($helper)
	{
		if (method_exists($this, $helper)) {
			return callback($this, $helper);
		}
	}



	/**
	 * Transfer time to words
	 *
	 * @param $time
	 *
	 * @return bool|string
	 */
	public static function timeToWords($time)
	{
		$helper = new Helper\TimeToWords;

		return $helper::transfer($time);
	}





}