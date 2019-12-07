<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControlleTest extends WebTestCase
{
    private $client = null;

    protected function setUp()
    {
        $this->markTestIncomplete();

        //parent::setUp();
        //self::bootKernel();
        //$kernel = static::bootKernel();
        //$this->client = static::createClient();
    }

    /**
     * @test
     * @dataProvider getBackEndUrls
     */
    public function protect_backend_from_anonymus_users_redirect_to_login(string $httpMethod, string $url)
    {
        $client = static::createClient();

        //$client = $this->createClient();//  static::createClient();
        $client->request($httpMethod, $url);

        $this->assertTrue($client->getResponse()->isRedirect());
        $crawler = $client->followRedirect('/login');
        $this->assertTrue($crawler->filter('html:contains("Please sign in")')->count() > 0);
    }

//    public function getUrlsForAnonymusUsers()
//    {
//        yield ['GET', '/admin/patient/'];
//    }
//
    public function getBackEndUrls()
    {
        yield ['GET', '/admin/patient/'];
    }

//    public function testShowPost()
//    {
//        $client = static::createClient([],[]);
//
//        $this->client->request('GET', '/');
//
//        $this->client->assertEquals(200, $this->client->getResponse()->getStatusCode());
//    }
}
