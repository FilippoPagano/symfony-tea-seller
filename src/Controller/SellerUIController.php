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
			return new Response('
		<div id="app">
			<div id="event-handling">
				<label for="domainInput">Domain where to look for sellers.json:</label>
				<input id="domainInput" v-model="domain" />
				<button v-on:click="sendRequest">Inspect sellers.json of {{ domain }}</button>
				<textarea id="sellersText" style="width:100%; height: 40ch">{{ sellers }}</textarea>
			</div>
		</div>
		<script src="https://unpkg.com/vue@next"></script>
		<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
		<script>
			//const axios = require("axios");
			const EventHandling = {
				data() {
					return {
						domain: "amazon.com",
						sellers: ""
					}
				},
				methods: {
					sendRequest() {
						this.sellers = "Loading...";
						axios.get("/sellers/" + this.domain)
						.then(function (response) {
							// handle success
							this.sellers = JSON.stringify(response.data);
						})
						.catch(function (error) {
							// handle error
							this.sellers = "An error occurred";
						})
						.then(function () {
							document.getElementById("sellersText").innerHTML = this.sellers;
							//yes, I broke it...
						});
						
					}
				}
			}
			
			Vue.createApp(EventHandling).mount("#event-handling");
			
		</script>
');
		}

	}
