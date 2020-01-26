<?php

namespace App\Tests\E2E;

use App\Tests\Support\Fixtures\UserFixturesBehaviorTrait;
use Symfony\Component\HttpFoundation\Response;

class SecurityControllerTest extends EndToEndTestCase
{
    use UserFixturesBehaviorTrait;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function login_page_is_accesible_for_visitor(): void
    {
        //$client = static::createPantherClient('127.0.0.1', '9001');
        //$this->loadDataFixtures();
        $client = static::createPantherClient();

        $crawler = $client->request('GET', '/login');

        $this->assertPageTitleContains('Log in!');
    }

    /** @test */
    public function a_visitor_with_wrong_credentials_cant_logged_in(): void
    {
        self::markTestSkipped('Fix local error: session not created: This version of ChromeDriver only supports Chrome version 79. This test is ok in travis.');
        $client = static::createPantherClient();
        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Sign in')->form();
        $form['email'] = 'fake-user@example.com';
        $form['password'] = 'password';
        $crawler = $client->submit($form);

        $this->assertSame(self::$baseUri.'/login', $client->getCurrentURL());
        // TODO assert form error message is visible.
        //$client->takeScreenshot('screen-login.png');
    }

    /** @test */
    public function a_visitor_with_credentials_can_logged_in(): void
    {
        self::markTestIncomplete('No Fixture. TODO Populate database with user -- Fix local error: session not created: This version of ChromeDriver only supports Chrome version 79. This test is ok in travis.');
        //$this->persistenceManager()->loadDataFixtures();
        //$this->populateDbWithAdminUser();// populateDbWithAdminUser
        //\DAMA\DoctrineTestBundle\Doctrine\DBAL\StaticDriver::commit();
        //die;
        $client = static::createPantherClient(['external_base_uri' => 'http://localhost:8000']); //['external_base_uri' => 'http://localhost:8000']
        $crawler = $client->request('GET', '/login');

//        $client->waitFor('#login-form');
//        $form = $crawler->filter('#login-form')->form(
//            [
//                'email' => 'admin@example.com',
//                'password' => 'admin',
//            ]
//        );
//        $client->submit($form);
//        //echo $client->getPageSource();
//        $client->takeScreenshot('screen-login-1.png');
//        $client->wait(3);
//        //$client->executeScript("document.querySelector('.btn btn-lg btn-primary').click()");
//        $client->takeScreenshot('screen-login.png');

        $form = $crawler->selectButton('Sign in')->form();
        $form['email'] = 'admin@example.com';
        $form['password'] = 'admin';
        $crawler = $client->submit($form);

        //not valid in panther
        //$crawler = $client->followRedirect();
        //$this->assertTrue($client->getResponse()->isRedirect(), 'Error: No redirect after login form.');

        $this->assertTrue($crawler->filter('html:contains("Account")')->count() > 0, 'Error: No redirect after successful Login.');
    }

    private function populateDbWithAdminUser(): void
    {
        $adminUser = $this->createAdminUser();
        $adminUser->setEmail('admin-panther@example.com');
        $adminUser->setPassword('admin');

        $this->persistenceManager()->save($adminUser);
    }

//    /** @test */
//    public function a_visitor_with_credentials_can_logged_in(): void
//    {
//        //self::markTestSkipped();
//        //$this->per
//        //self::loadDataFixtures();
//        $this->persistenceManager()->loadDataFixtures();
//        $client = static::createPantherClient([]);
//        //$client = static::createPantherClient(['external_base_uri' => 'http://localhost:8000']);
//        $crawler = $client->request('GET', '/login');
//        $form = $crawler->selectButton('Sign in')->form();
//        $form['email'] = 'admin@example.com';
//        $form['password'] = 'admin';
//        $crawler = $client->submit($form);
//
//        $client->wait(2);// waitFor('#comments ol');
    ////
//        echo $client->getPageSource();
//
//
    ////        $crawler = $client->request('GET', '/admin/user/');
//        //echo $client->getPageSource();
//        //$this->assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());
//
    ////        $this->assertContains(
    ////            'user.index_title ',
    ////            $client->getTitle()
    ////        );
//
//    }

    /**
     * @test
     * @dataProvider getBackEndUrls
     */
    public function protect_backend_from_anonymus_users_redirect_to_login(string $httpMethod, string $url): void
    {
        $client = static::createClient();
        $client->request($httpMethod, $url);

        $this->assertTrue($client->getResponse()->isRedirect());
        $crawler = $client->followRedirect();
        $this->assertTrue($crawler->filter('html:contains("Login")')->count() > 0);
    }

    /**
     * @return \Generator<array>
     */
    public function getBackEndUrls(): \Generator
    {
        yield ['GET', '/admin/patient/'];
        yield ['GET', '/admin/user/'];
    }
}
