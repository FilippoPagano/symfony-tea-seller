<?php
	// src/Controller/SellerUIController.php
	namespace App\Controller;
	
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;
	
	
	class SellerUIController extends AbstractController
	{
		/**
			* @Route("/sellersUI", methods={"GET"})
		*/
		public function show(): Response
		{	
			ob_start();
			include 'ui.html';
			$ui = ob_get_clean();
			return new Response($ui);
		}
		
	}
