<?php

	final class QValidator_Factory {
		
		/**
		 * Class constructor
		 *
		 * @access			public
		 * @introduced		2021/12/15
		 *
		 * @return			void
		 */
		 
		public function __construct() {}
		
		/**
		 * Return validation for a date
		 *
		 * @param	$field_name		string
		 *
		 * @access			public
		 * @introduced		2022/01/08
		 * @static
		 *
		 * @return			object typeof 
		 */
		 
		static public function array( string $field_name ) : QValidator_Condition {
			return QValidator::factory()
				-> addCondition( new QValidator_Condition_Required( $field_name ) )
				-> addCondition( new QValidator_Condition_Is_Array( $field_name ) );
		}

		/**
		 * Return validation for a date
		 *
		 * @param	$field_name		string
		 *
		 * @access			public
		 * @introduced		2022/01/01
		 * @static
		 *
		 * @return			object typeof 
		 */
		 
		static public function date( string $field_name ) : QValidator_Condition {
			return QValidator::factory()
				-> addCondition( new QValidator_Condition_Required( $field_name ) )
				-> addCondition( new QValidator_Condition_Expression( $field_name, QExpressions::DATE_ONLY ) )
				-> addCondition( new QValidator_Condition_Size( $field_name, 10 ) );
		}
		
		/**
		 * Return validation for a body of text, variable length
		 *
		 * @param	$field_name		string
		 * @param	$size			int
		 *
		 * @access			public
		 * @introduced		2022/01/01
		 * @static
		 *
		 * @return			object typeof 
		 */
		 
		static public function textarea( string $field_name, int $size ) : QValidator_Condition {
			return QValidator::factory()
				-> addCondition( new QValidator_Condition_Required( $field_name ) )
				-> addCondition( new QValidator_Condition_Size_Maximum( $field_name, $size ) );
		}

		/**
		 * Return validation for a decimal (float) number
		 *
		 * @param	$field_name		string
		 * @param	$size			int
		 *
		 * @access			public
		 * @introduced		2021/12/30
		 * @static
		 *
		 * @return			object typeof 
		 */
		 
		static public function decimal( string $field_name, int $size ) : QValidator_Condition {
			return QValidator::factory()
				-> addCondition( new QValidator_Condition_Required( $field_name ) )
				-> addCondition( new QValidator_Condition_Expression( $field_name, QExpressions::DECIMAL ) )
				-> addCondition( new QValidator_Condition_Size_Maximum( $field_name, $size ) );
		}
		
		/**
		 * Return validation for a defined number of characters exact, 0-9 only
		 *
		 * @param	$field_name		string
		 * @param	$size			int
		 *
		 * @access			public
		 * @introduced		2021/12/30
		 * @static
		 *
		 * @return			object typeof 
		 */
		 
		static public function id( string $field_name, int $size ) : QValidator_Condition {
			return QValidator::factory()
				-> addCondition( new QValidator_Condition_Required( $field_name ) )
				-> addCondition( new QValidator_Condition_Expression( $field_name, QExpressions::NUMERICS_ONLY ) )
				-> addCondition( new QValidator_Condition_Size( $field_name, $size ) );
		}
		
		/**
		 * Return validation for a variable number of characters exact, 0-9 only
		 *
		 * @param	$field_name		string
		 * @param	$size			int
		 *
		 * @access			public
		 * @introduced		2021/12/15
		 * @static
		 *
		 * @return			object typeof 
		 */
		 
		static public function numeric( string $field_name, int $size ) : QValidator_Condition {
			return QValidator::factory()
				-> addCondition( new QValidator_Condition_Required( $field_name ) )
				-> addCondition( new QValidator_Condition_Expression( $field_name, QExpressions::NUMERICS_ONLY ) )
				-> addCondition( new QValidator_Condition_Size_Maximum( $field_name, $size ) );
		}
		
		/**
		 * Return validation for a variable number of characters exact, a-z, A-Z only
		 *
		 * @param	$field_name		string
		 * @param	$size			int
		 *
		 * @access			public
		 * @introduced		2021/12/15
		 * @static
		 *
		 * @return			object typeof 
		 */
		 
		static public function alpha( string $field_name, int $size ) : QValidator_Condition {
			return QValidator::factory()
				-> addCondition( new QValidator_Condition_Required( $field_name ) )
				-> addCondition( new QValidator_Condition_Expression( $field_name, QExpressions::ALPHA_CHARS_ONLY ) )
				-> addCondition( new QValidator_Condition_Size_Maximum( $field_name, $size ) );
		}
		
		/**
		 * Return validation for a variable number of characters exact, a-z, A-Z and SPACE only
		 *
		 * @param	$field_name		string
		 * @param	$size			int
		 *
		 * @access			public
		 * @introduced		2022/01/01
		 * @static
		 *
		 * @return			object typeof 
		 */
		 
		static public function alphaWithSpaces( string $field_name, int $size ) : QValidator_Condition {
			return QValidator::factory()
				-> addCondition( new QValidator_Condition_Required( $field_name ) )
				-> addCondition( new QValidator_Condition_Expression( $field_name, QExpressions::ALPHA_CHARS_WITH_SPACES ) )
				-> addCondition( new QValidator_Condition_Size_Maximum( $field_name, $size ) );
		}
		
		/**
		 * Return validation for a variable number of characters exact, a-z, A-Z, 0-9 only
		 *
		 * @param	$field_name		string
		 * @param	$size			int
		 *
		 * @access			public
		 * @introduced		2021/12/15
		 * @static
		 *
		 * @return			object typeof 
		 */
		 
		static public function alphaNumeric( string $field_name, int $size ) : QValidator_Condition {
			return QValidator::factory()
				-> addCondition( new QValidator_Condition_Required( $field_name ) )
				-> addCondition( new QValidator_Condition_Expression( $field_name, QExpressions::ALPHA_NUMERICS_ONLY ) )
				-> addCondition( new QValidator_Condition_Size_Maximum( $field_name, $size ) );
		}
		
		/**
		 * Return validation for a variable number of characters exact, a-z, A-Z, 0-9 and SPACE only
		 *
		 * @param	$field_name		string
		 * @param	$size			int
		 *
		 * @access			public
		 * @introduced		2021/12/15
		 * @static
		 *
		 * @return			object typeof 
		 */
		 
		static public function alphaNumericWithSpaces( string $field_name, int $size ) : QValidator_Condition {
			return QValidator::factory()
				-> addCondition( new QValidator_Condition_Required( $field_name ) )
				-> addCondition( new QValidator_Condition_Expression( $field_name, QExpressions::ALPHA_NUMERICS_WITH_SPACES ) )
				-> addCondition( new QValidator_Condition_Size_Maximum( $field_name, $size ) );
		}
		
		/**
		 * Return validation for a form hash token
		 *
		 * @param	$field_name		string
		 *
		 * @access			public
		 * @introduced		2021/12/15
		 * @static
		 *
		 * @return			object typeof 
		 */
		 
		static public function formToken( string $field_name ) : QValidator_Condition {
			return QValidator::factory()
				-> addCondition( new QValidator_Condition_Required( $field_name ) )
				-> addCondition( new QValidator_Condition_Size( $field_name, QCommon::PK_STANDARD ) )
				-> addCondition( new QValidator_Condition_Security_Session_Token( $field_name ) )
				-> addCondition( new QValidator_Condition_Expression( $field_name, QExpressions::ALPHA_NUMERICS_ONLY ) );
		}
		
		/**
		 * Return validation for a generic telephone number, 0-9, []-()+ characters
		 *
		 * @param	$field_name		string
		 *
		 * @access			public
		 * @introduced		2021/12/15
		 * @static
		 *
		 * @return			object typeof 
		 */
		 
		static public function telephone( string $field_name ) : QValidator_Condition {
			return QValidator::factory()
				-> addCondition( new QValidator_Condition_Required( $field_name ) )
				-> addCondition( new QValidator_Condition_Expression( $field_name, QExpressions::TELEPHONE ) )
				-> addCondition( new QValidator_Condition_Size_Maximum( $field_name, 24 ) );
		}
		
		/**
		 * Return validation for email address
		 *
		 * @param	$field_name		string
		 *
		 * @access			public
		 * @introduced		2021/12/15
		 * @static
		 *
		 * @return			object typeof 
		 */
		 
		static public function emailAddress( string $field_name ) : QValidator_Condition {
			return QValidator::factory()
				-> addCondition( new QValidator_Condition_Required( $field_name ) )
				-> addCondition( new QValidator_Condition_Expression( $field_name, QExpressions::EMAIL_ADDRESS ) )
				-> addCondition( new QValidator_Condition_Size_Maximum( $field_name, 64 ) );
		}
		
		/**
		 * Return validation for web address
		 *
		 * @param	$field_name		string
		 *
		 * @access			public
		 * @introduced		2021/12/15
		 * @static
		 *
		 * @return			object typeof 
		 */
		 
		static public function webAddress( string $field_name ) : QValidator_Condition {
			return QValidator::factory()
				-> addCondition( new QValidator_Condition_Required( $field_name ) )
				-> addCondition( new QValidator_Condition_Expression( $field_name, QExpressions::WEB_ADDRESS ) )
				-> addCondition( new QValidator_Condition_Size_Maximum( $field_name, 768 ) );
		}
		
		/**
		 * Return validation for a password
		 *
		 * @param	$field_name		string
		 * @param	$maximum		int
		 *
		 * @access			public
		 * @introduced		2021/12/15
		 * @static
		 *
		 * @return			object typeof 
		 */
		 
		static public function password( string $field_name, int $maximum ) : QValidator_Condition {
			return QValidator::factory()
				-> addCondition( new QValidator_Condition_Required( $field_name ) )
				-> addCondition( new QValidator_Condition_Expression( $field_name, '/^[a-zA-Z0-9]+$/' ) )
				-> addCondition( new QValidator_Condition_Size_Minimum( $field_name, 6 ) )
				-> addCondition( new QValidator_Condition_Size_Maximum( $field_name, $maximum ) );
		}
		
		/**
		 * Return validation for a ISO 2 character code
		 *
		 * @param	$field_name		string
		 *
		 * @access			public
		 * @introduced		2021/12/30
		 * @static
		 *
		 * @return			object typeof 
		 */
		 
		static public function iso2( string $field_name ) : QValidator_Condition {
			return QValidator::factory()
				-> addCondition( new QValidator_Condition_Required( $field_name ) )
				-> addCondition( new QValidator_Condition_Expression( $field_name, QExpressions::ISO_2_STANDARD ) )
				-> addCondition( new QValidator_Condition_Size( $field_name, 2 ) );
		}
		
		/**
		 * Return validation for a ISO 3 character code
		 *
		 * @param	$field_name		string
		 *
		 * @access			public
		 * @introduced		2021/12/15
		 * @static
		 *
		 * @return			object typeof 
		 */
		 
		static public function iso3( string $field_name ) : QValidator_Condition {
			return QValidator::factory()
				-> addCondition( new QValidator_Condition_Required( $field_name ) )
				-> addCondition( new QValidator_Condition_Expression( $field_name, QExpressions::ISO_3_STANDARD ) )
				-> addCondition( new QValidator_Condition_Size( $field_name, 3 ) );
		}
		
		/**
		 * Return validation for a ISO 3 character code
		 *
		 * @param	$field_name		string
		 * @param	$size			int
		 *
		 * @access			public
		 * @introduced		2021/12/15
		 * @static
		 *
		 * @return			object typeof 
		 */
		 
		static public function unicode( string $field_name, int $size ) : QValidator_Condition {
			return QValidator::factory()
				-> addCondition( new QValidator_Condition_Required( $field_name ) )
				-> addCondition( new QValidator_Condition_Expression( $field_name, QExpressions::UNICODE ) )
				-> addCondition( new QValidator_Condition_Size_Maximum( $field_name, $size ) );
		}
		
		/**
		 * Return validation for range, or ENUM
		 *
		 * @param	$field_name		string
		 *
		 * @access			public
		 * @introduced		2021/12/30
		 * @static
		 *
		 * @return			object typeof 
		 */
		 
		static public function activeOrInactive( string $field_name ) : QValidator_Condition {
			return QValidator::factory()
				-> addCondition( new QValidator_Condition_Required( $field_name ) )
				-> addCondition( new QValidator_Condition_Expression( $field_name, '/(active|inactive)/' ) );
		}
		
		/**
		 * Return validation for range, or ENUM
		 *
		 * @param	$field_name		string
		 *
		 * @access			public
		 * @introduced		2021/12/30
		 * @static
		 *
		 * @return			object typeof 
		 */
		 
		static public function yesOrNo( string $field_name ) : QValidator_Condition {
			return QValidator::factory()
				-> addCondition( new QValidator_Condition_Required( $field_name ) )
				-> addCondition( new QValidator_Condition_Expression( $field_name, '/(yes|no)/' ) );
		}
		
	}
	
?>