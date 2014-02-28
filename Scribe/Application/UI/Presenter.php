<?php

/**
 * Copyright (c) 2014 David Zadražil (me@davidzadrazil.cz)
 *
 * For the full copyright and license information, please view the file license.txt that was distributed with this source code.
 */

namespace Scribe\Application\UI;

use Nette,
	Nette\Application\ForbiddenRequestException;

/**
 * Class Presenter
 *
 * @author David Zadražil <me@davidzadrazil.cz>
 */
abstract class Presenter extends Nette\Application\UI\Presenter
{

	/** @persistent */
	public $locale;

	/** @var \Kdyby\Translation\Translator @inject */
	public $translator;



	/**
	 * Check requirements
	 *
	 * @param $element
	 *
	 * @throws \Nette\Application\ForbiddenRequestException
	 */
	public function checkRequirements($element)
	{
		if ($element->hasAnnotation('Secured')) {

			// check user login
			if (!$this->user->isLoggedIn()) {
				$this->redirect("Uzivatel:prihlaseni", array("backlink" => $this->storeRequest()));
			}

			// check if user is in role
			if ($element->hasAnnotation("Role")) {
				if (!$this->user->isInRole($element->getAnnotation('Role'))) {
					throw new Nette\Application\ForbiddenRequestException;
				}
			}

			// check if user is allowed to do something...
			if ($element->hasAnnotation("Resource")) {
				if (!$this->user->isAllowed($element->getAnnotation("Resource"), $element->getAnnotation("Privilege"))) {
					throw new Nette\Application\ForbiddenRequestException;
				}
			}

		}
	}

}