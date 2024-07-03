<?php

/**
 * Copyright © Ebrahim Byagowi, 2024
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 */

namespace MediaWiki\Extension\InChI;

use Html;
use MediaWiki\Hook\ParserFirstCallInitHook;
use MediaWiki\Parser\Parser;
use PPFrame;

class Hooks implements ParserFirstCallInitHook {
	/**
	 * Hook function for {{#InChI:input}}
	 *
	 * @param Parser $parser
	 * @param PPFrame $frame
	 * @param array $args
	 * @return array
	 */
	public function inchiHook( Parser $parser, PPFrame $frame, array $args ) {
		return [
			Html::rawElement(
				'img',
				[
					'src' => "https://chemistoid.toolforge.org/InChI=$args[0]",
					'class' => 'skin-invert',
				]
			),
			'noparse' => true,
			'isHTML' => true,
		];
	}

	/**
	 * Register parser hooks.
	 *
	 * @param Parser $parser
	 * @return bool
	 */
	public function onParserFirstCallInit( $parser ) {
		$parser->setFunctionHook( 'inchi', [ $this, 'inchiHook' ], Parser::SFH_OBJECT_ARGS );
		return true;
	}
}
