<?php

namespace App\Tests\Functional;

use Symfony\Component\Panther\PantherTestCase;

class SecurityControllerTest extends PantherTestCase
{
    public function login_page_is_accesible_for_visitor(): void
    {
        //$client = static::createPantherClient('127.0.0.1', '9001');
        $client = static::createPantherClient();

        $crawler = $client->request('GET', '/login');

        $this->assertPageTitleContains('Log in!');
    }

    /** @test */
    public function a_visitor_with_wrong_credentials_cant_logged_in(): void
    {
        $client = static::createPantherClient();
        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Sign in')->form();
        $form['email'] = 'fake-user@example.com';
        $form['password'] = 'password';
        $crawler = $client->submit($form);

        $this->assertSame(self::$baseUri.'/login', $client->getCurrentURL());
        // TODO assert form error message is visible.
        $client->takeScreenshot('screen-login.png');
    }

    /** @test */
    public function a_visitor_with_credentials_can_logged_in(): void
    {
        self::markTestSkipped();
    }

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
