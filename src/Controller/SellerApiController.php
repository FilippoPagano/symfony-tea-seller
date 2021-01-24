<?php
	// src/Controller/SellerApiController.php
	namespace App\Controller;
	
	use App\Entity\Seller;
	use Doctrine\ORM\EntityManagerInterface;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;
	use Symfony\Component\HttpClient\HttpClient;
	use App\Analyzer\SellersJsonSimpleAnalyzer;
	
	
	class SellerApiController extends AbstractController
	{
		/**
			* @Route("/sellers/{domain}", methods={"GET"})
		*/
		public function show(string $domain): Response
		{
			$entityManager = $this->getDoctrine()->getManager();
			
			$client = HttpClient::create();
			$response = $client->request('GET', 'http://'.$domain.'/sellers.json');
			
			if($response->getStatusCode()!=200){
				return $this->teaTime();
			}
			
			$analyzer = new SellersJsonSimpleAnalyzer();
			$analysisResult = $analyzer->analyze($response->getContent());
			if(!$analysisResult->getIsValid()){
				return $this->teaTime();
			}
			
			$sellers = $analysisResult->getSellers();
			
			foreach ($sellers as $cur){
				$seller = new Seller($cur->name, $cur->seller_id, $cur->seller_type);
				if(isset($cur->comment)) {
					$seller->setComment($cur->comment);
				}
				if(isset($cur->is_confidential)) {
					$seller->setIsConfidential($cur->is_confidential);
				}
				if(isset($cur->is_passthrough)) {
					$seller->setIsPassthrough($cur->is_passthrough);
				}
				if(isset($cur->domain)) {
					$seller->setDomain($cur->domain);
				}
				$entityManager->persist($seller);
			}
			$entityManager->flush();
			
			return new Response(json_encode($sellers));
		}
		
		private function teaTime() : Response {
			$response = new Response();
			$response->setStatusCode(418);
			$response->setContent('<html><body>418 status code<br>Request failed :(<br>Have some tea!</body></html>');
			return $response;
		}
	}
