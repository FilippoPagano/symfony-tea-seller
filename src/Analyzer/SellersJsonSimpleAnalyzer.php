<?php
	
	declare(strict_types=1);
	
	namespace App\Analyzer;
	use App\Entity\AnalysisResult;
	
	/**
		* SellersJsonSimpleAnalyzer.
	*/
	class SellersJsonSimpleAnalyzer implements SellersJsonAnalyzerInterface
	{
		/**
			* {@inheritdoc}
		*/
		public function analyze(string $associativeSellersJson): AnalysisResult
		{
			$result = new AnalysisResult();
			$isValidJson = @json_decode($associativeSellersJson);
			$result->setIsValid(true);
			$result->setReasons([]);
			if(!$isValidJson){
				$result->setIsValid(false);
				$result->setReasons(["not a valid JSON"]);
				return $result;
			}
			$inputObject = json_decode($associativeSellersJson);
			
			if(!isset($inputObject->version)){
				$result->setIsValid(false);
				$result->setReasons(["no version is present in provided sellers.json"]);				
			} 
			else {
				if($inputObject->version != "1" && $inputObject->version != "1.0"){
					$result->setIsValid(false);
					$result->setReasons(["wrong version"]);				
				}
			}
			if(!isset($inputObject->sellers)){
				$result->setIsValid(false);
				$result->setReasons(array_push($result->getReasons(),"no sellers in input json"));
			} 
			else {
				$sellers = $inputObject->sellers;
				$result->setSellers($sellers);
				$invalidSellers = array_filter($sellers, function($seller){
					if (isset($seller->seller_type)) {
						if (strtoupper($seller->seller_type) != "PUBLISHER" && 
						strtoupper($seller->seller_type) != "INTERMEDIARY" && 
						strtoupper($seller->seller_type) != "BOTH") return true;
					}
					else {
						return true;
					}
					return false;
					
				});
				if(!empty($invalidSellers)){
					$result->setIsValid(false);
					$reasons = $result->getReasons();
					array_push($reasons,"some sellers have wrong type");
					$result->setReasons($reasons);
					$result->setInvalidSellers($invalidSellers);
				}
			}
			return $result;
		}
	}																