<?php
/**
 * Get all variants of word for Serbian language.
 *
 * @package   Serbian_Variants
 * @version   1.0
 * @author    Milan Dinić <blog.milandinic.com>
 * @copyright Copyright (c) 2015, Milan Dinić
 * @license   http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link      https://github.com/dimadin/serbian-variants
 */


if ( ! class_exists( 'Serbian_Variants' ) ) :
/**
 * The Serbian Variants Class
 *
 * Get all variants of word for Serbian language.
 *
 * @since 1.0.0
 */
class Serbian_Variants {
	/**
	 * Original string without modifications.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @var string
	 */
	public $original_term;

	/**
	 * An array with all variants of original string.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @var array
	 */
	public $variants;

	/**
	 * Get all variants of string for Serbian language. 
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $term String for which all variants are searched for.
	 */
	public function __construct( $term ) {
		// Store original term
		$this->original_term = $term;

		// Store an array with all variants
		$this->variants = array( $term );

		// Convert to Latin or Cyrillic
		$this->to_cyrillic();
		$this->to_latin();

		// Loop through all characters in all variants and add all new variants, twice
		$this->parse_all();
		$this->parse_all();

		// Convert new variants to Latin or Cyrillic
		$this->to_cyrillic();
		$this->to_latin();
	}

	/**
	 * Convert all characters to Cyrillic.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function to_cyrillic() {
		$replace = array(
			'A'  => 'А',
			'B'  => 'Б',
			'V'  => 'В',
			'G'  => 'Г',
			'D'  => 'Д',
			'Đ'  => 'Ђ',
			'E'  => 'Е',
			'Ž'  => 'Ж',
			'Z'  => 'З',
			'I'  => 'И',
			'J'  => 'Ј',
			'K'  => 'К',
			'L'  => 'Л',
			'Lj' => 'Љ',
			'M'  => 'М',
			'N'  => 'Н',
			'Nj' => 'Њ',
			'O'  => 'О',
			'P'  => 'П',
			'R'  => 'Р',
			'S'  => 'С',
			'T'  => 'Т',
			'Ć'  => 'Ћ',
			'U'  => 'У',
			'F'  => 'Ф',
			'H'  => 'Х',
			'C'  => 'Ц',
			'Č'  => 'Ч',
			'Dž' => 'Џ',
			'Š'  => 'Ш',
			'a'  => 'а',
			'b'  => 'б',
			'v'  => 'в',
			'g'  => 'г',
			'd'  => 'д',
			'đ'  => 'ђ',
			'e'  => 'е',
			'ž'  => 'ж',
			'z'  => 'з',
			'i'  => 'и',
			'j'  => 'ј',
			'k'  => 'к',
			'l'  => 'л',
			'lj' => 'љ',
			'm'  => 'м',
			'n'  => 'н',
			'nj' => 'њ',
			'o'  => 'о',
			'p'  => 'п',
			'r'  => 'р',
			's'  => 'с',
			't'  => 'т',
			'ć'  => 'ћ',
			'u'  => 'у',
			'f'  => 'ф',
			'h'  => 'х',
			'c'  => 'ц',
			'č'  => 'ч',
			'dž' => 'џ',
			'š'  => 'ш',
		);

		// Replace all characters with Cyrillic ones
		$replacements = array();
		foreach ( $this->variants as $term ) {
			$replacements[] = strtr( $term, $replace);
		}

		$this->merge_and_unique( $replacements );
	}

	/**
	 * Convert all characters to Latin.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function to_latin() {
		$replace = array(
			'А' => 'A',
			'Б' => 'B',
			'В' => 'V',
			'Г' => 'G',
			'Д' => 'D',
			'Ђ' => 'Đ',
			'Е' => 'E',
			'Ж' => 'Ž',
			'З' => 'Z',
			'И' => 'I',
			'Ј' => 'J',
			'К' => 'K',
			'Л' => 'L',
			'Љ' => 'Lj',
			'М' => 'M',
			'Н' => 'N',
			'Њ' => 'Nj',
			'О' => 'O',
			'П' => 'P',
			'Р' => 'R',
			'С' => 'S',
			'Т' => 'T',
			'Ћ' => 'Ć',
			'У' => 'U',
			'Ф' => 'F',
			'Х' => 'H',
			'Ц' => 'C',
			'Ч' => 'Č',
			'Џ' => 'Dž',
			'Ш' => 'Š',
			'а' => 'a',
			'б' => 'b',
			'в' => 'v',
			'г' => 'g',
			'д' => 'd',
			'ђ' => 'đ',
			'е' => 'e',
			'ж' => 'ž',
			'з' => 'z',
			'и' => 'i',
			'ј' => 'j',
			'к' => 'k',
			'л' => 'l',
			'љ' => 'lj',
			'м' => 'm',
			'н' => 'n',
			'њ' => 'nj',
			'о' => 'o',
			'п' => 'p',
			'р' => 'r',
			'с' => 's',
			'т' => 't',
			'ћ' => 'ć',
			'у' => 'u',
			'ф' => 'f',
			'х' => 'h',
			'ц' => 'c',
			'ч' => 'č',
			'џ' => 'dž',
			'ш' => 'š',
		);

		// Replace all characters with Latin ones
		$replacements = array();
		foreach ( $this->variants as $term ) {
			$replacements[] = strtr( $term, $replace);
		}

		$this->merge_and_unique( $replacements );
	}

	/**
	 * Parse all strings for all variants.
	 *
	 * Loop through all strings and create all variants
	 * of that string, and if there are new, add to array
	 * with all strings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function parse_all() {
		// Loop through all variants
		foreach ( $this->variants as $term ) {
			// Get all variants of a string
			$this->parse_str( $term, 1 );
			$this->parse_str( $term, 2 );
		}
	}

	/**
	 * Parse string for all variants.
	 *
	 * Loop through all characters and if there might be
	 * more than one possible variant of that character,
	 * replace it and add new string to array with all
	 * strings.
	 *
	 * @since 1.0.0
	 * @access protected
	 *
	 * @param string $term   String that is searched for.
	 * @param int    $length Length of searched needle.
	 */
	protected function parse_str( $term, $length = 1 ) {
		// Split term into array with each character
		$chars = str_split( $term, $length );
		foreach ( $chars as $index => $char ) {
			// Add new string with replacement of each character
			switch ( $char ) {
				case 'c' :
					$this->substr_replace( $term, 'ć', $index, $length );
					$this->substr_replace( $term, 'č', $index, $length );
					break;
				case 'ć' :
					$this->substr_replace( $term, 'c', $index, $length );
					$this->substr_replace( $term, 'č', $index, $length );
					break;
				case 'č' :
					$this->substr_replace( $term, 'c', $index, $length );
					$this->substr_replace( $term, 'ć', $index, $length );
					break;
				case 'z' :
					$this->substr_replace( $term, 'ž', $index, $length );
					break;
				case 'ž' :
					$this->substr_replace( $term, 'z', $index, $length );
					break;
				case 's' :
					$this->substr_replace( $term, 'š', $index, $length );
					break;
				case 'š' :
					$this->substr_replace( $term, 's', $index, $length );
					break;
				case 'đ' :
					$this->substr_replace( $term, 'dj', $index, $length );
					break;
				case 'ch' :
				case 'cx' :
				case 'cc' :
					$this->substr_replace( $term, 'č', $index, $length );
					break;
				case 'cy' :
					$this->substr_replace( $term, 'ć', $index, $length );
					break;
				case 'dj' :
				case 'dx' :
					$this->substr_replace( $term, 'đ', $index, $length );
					break;
				case 'zh' :
				case 'zx' :
				case 'zz' :
					$this->substr_replace( $term, 'ž', $index, $length );
					break;
				case 'sx' :
				case 'sh' :
				case 'ss' :
					$this->substr_replace( $term, 'š', $index, $length );
					break;
			}
		}
	}

	/**
	 * Replace character in string and get all variants of new.
	 *
	 * @since 1.0.0
	 * @access protected
	 *
	 * @param string $term        String that is searched for.
	 * @param string $replacement String with which needle is replaced.
	 * @param int    $start       Start of character from beginning of $term.
	 * @param int    $length      Length of replaced needle.
	 */
	protected function substr_replace( $term, $replacement, $start, $length ) {
		$new_term = substr_replace( $term, $replacement, $start, $length );

		if ( ! in_array( $new_term, $this->variants ) ) {
			$this->merge_and_unique( array( $new_term ) );

			if ( 1 === $length ) {
				$this->parse_str( $new_term );
			}
		}
	}

	/**
	 * Merge with master array, get unique values, and reset keys.
	 *
	 * @since 1.0.0
	 * @access protected
	 *
	 * @param array $new_terms An array with all variants that are merged.
	 */
	protected function merge_and_unique( $new_terms ) {
		$this->variants = array_values( array_unique( array_merge( $this->variants, $new_terms ) ) );
	}
}
endif;
