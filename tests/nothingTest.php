<?php

	use PHPUnit\Framework\TestCase;
	
	/**
	 ** @covers Nothing
	 */
	
	final class nothingTest extends TestCase {
		protected function setUp() : void {
			parent::setUp();
		}

		protected function tearDown() : void {
			parent::tearDown();
		}

		/** @test
		 ** @covers Nothing::Ignore
		 ** @introduced		2022/
		 */

		public function testNothingIsReal() : void {
			$this -> assertTrue( true );
		}

	}

?>