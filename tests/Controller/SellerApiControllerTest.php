<?php
// tests/Controller/SellerApiControllerTest.php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SellerApiControllerTest extends WebTestCase
{
    public function testShowPost()
    {
        $client = static::createClient();

        $client->request('GET', '/sellers/amazon.com');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
		  
        $client->request('GET', '/sellers/ciao.it');

        $this->assertEquals(418, $client->getResponse()->getStatusCode());
    }
}