<?php

	final class QPage_Renderer_Decorator extends QDataspace implements QPage_Interface, QOperator_Interface{
		protected QPage_Interface $decorated;

		/**
		 * Class constructor
		 * 
		 * @param	$dataspace 		object typeof QDataspace_Interface
		 * 
		 * @access			public
		 * @introduced		2022/01/20
		 * @return			void
		 */

		public function __construct( QDataspace_Interface $dataspace ) {
			parent::__construct( $dataspace );
		}

		/**
		 * Set the interface type that is to be decorated
		 * 
		 * @param 	$decorated  		object typeof QPage_Interface
		 * 
		 * @access			public
		 * @introduced		2022/01/20
		 * @return			void
		 */

		public function setDecorated( QPage_Interface $decorated ) : void {
			$this -> decorated = $decorated;
		}

		/**
		 * Determine if variable exists or not within $_SESSION
		 *
		 * @param	$key				string	key to look for
		 *
		 * @access						public
		 * @return						bool
		 */
		 
		public function hasSession( string $key ) : bool { 
			return $this -> decorated -> hasSession( $key );
		}
		
		/**
		 * Return a variable within $_SESSION
		 *
		 * @param	$key				string	key to look for
		 *
		 * @access						public
		 * @return						mixed
		 */
		 
		public function getSession( string $key ) { 
			return $this -> decorated -> getSession( $key );
		}
		
		/**
		 * Determine if variable exists or not within $_COOKIE
		 *
		 * @param	$key				string	key to look for
		 *
		 * @access						public
		 * @return						bool
		 */
		 
		public function hasCookie( string $key ) : bool { 
			return $this -> decorated -> hasCookie( $key );
		}
		
		/**
		 * Return a variable within $_COOKIE
		 *
		 * @param	$key				string	key to look for
		 *
		 * @access						public
		 * @return						mixed
		 */
		 
		public function getCookie( string $key ) { 
			return $this -> decorated -> getCookie( $key );
		}
		
		/**
		 * Perform an operation on $object
		 *
		 * @param	$object				object
		 *
		 * @access					public
		 * @introduced				2021/11/02
		 *
		 * @return					void
		 * @throws					QFront_Controller_Action_Dispatcher_Exception
		 */
		 
		public function operate( object $object ) {
			try {
				$object -> push( $this );
			} catch( QPage_Exception $e ) {
				throw new QFront_Controller_Action_Dispatcher_Exception( $e -> getMessage() );
			}
		}
		
		/**
		 * Escape string prior to output to template
		 *
		 * @param	$parameter		string	string to escape
		 * @param	$encoding		string	encoding to use for escape
		 *
		 * @access					public
		 * @return					string
		 */
		 
		public function escape( string $parameter, string $encoding = 'UTF-8' ) : string { 
			return $this -> decorated( $parameter, ENT_QUOTES, $encoding );
		}

		/**
		 * Render a given template with data from observers
		 *
		 * @param	$template		string
		 *
		 * @access					public
		 * @return					void
		 */
		 
		public function render( string $template ) : void { 
			include_once( $this -> prepare( $template ) );
		}

		/**
		 * Prepare template path based upon a language if found
		 *
		 * @param	$template		string	directory path to template
		 *
		 * @return					string	
		 * @access					protected
		 *
		 * @return			string
		 */
		 
		protected function prepare( string $template ) : string { 
			$base = dirname( QRegistry::get( '__protected' ) ).'/shared/';

			if( $this -> has( QCommon::LOCALE_LANGUAGE_TOKEN ) ) { 
				if( $this -> has( QCommon::LOCALE_COUNTRY_TOKEN ) ) {
					return $base.$this -> get( QCommon::LOCALE_LANGUAGE_TOKEN ).'/'.$this -> get( QCommon::LOCALE_COUNTRY_TOKEN ).'/'.$template;
				} else {
					return $base.$this -> get( QCommon::LOCALE_LANGUAGE_TOKEN ).'/'.$template;
				}
			} 
			
			return $base.$template;
		}
	}
	
?>