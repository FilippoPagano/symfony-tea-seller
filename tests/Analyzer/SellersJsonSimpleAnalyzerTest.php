<?php
	
	declare(strict_types=1);
	
	namespace App\Tests\Analyzer;
	
	use PHPUnit\Framework\TestCase;
	use App\Analyzer\SellersJsonSimpleAnalyzer;
	
	/**
		* SellersJsonSimpleAnalyzerTest.
		*
		* @coversDefaultClass \App\Analyzer\SellersJsonSimpleAnalyzer
	*/
	class SellersJsonSimpleAnalyzerTest extends TestCase
	{
		/**
			* Test that an exception is thrown when a not valid version is stored in the provided sellers.json.
			*
			* @covers ::analyze
		*/
		public function testAnalyzeWhenNotValidVersion(): void
		{
			$analyzer = new SellersJsonSimpleAnalyzer();
			$analysisResult = $analyzer->analyze('{"sellers":[]}');
			$this->assertEquals($analysisResult->getIsValid(), false);
			$this->assertContains("no version is present in provided sellers.json", $analysisResult->getReasons());
			$analysisResult = $analyzer->analyze('{"version": 2, "sellers":[]}');
			$this->assertEquals($analysisResult->getIsValid(), false);
			$this->assertContains("wrong version", $analysisResult->getReasons());
		}
		
		/**
			* Test that an exception is thrown when a not valid type is stored in a seller in the provided sellers.json.
			*
			* @covers ::analyze
		*/
		public function testAnalyzeWhenSellerHasNotValidType(): void
		{
			$analyzer = new SellersJsonSimpleAnalyzer();
			$analysisResult = $analyzer->analyze('{"sellers":[{"seller_id": "123","name": "123c","domain": "123","seller_type": "neither"}]}');
			$this->assertEquals($analysisResult->getIsValid(), false);
			$this->assertContains("some sellers have wrong type", $analysisResult->getReasons());
		}
		
		/**
			* Test that sellers are correctly noted based on the provided sellers.json.
			*
			* @covers ::analyze
		*/
		public function testAnalyze(): void
		{
			$analyzer = new SellersJsonSimpleAnalyzer();
			$analysisResult = $analyzer->analyze('{"sellers":[{"seller_id": "123","name": "123c","domain": "123","seller_type": "both"}]}');
			$this->assertEquals(count($analysisResult->getSellers()), 1);
		}
	}		