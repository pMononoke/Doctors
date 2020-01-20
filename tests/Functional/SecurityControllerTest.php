<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function login_page_is_accesible_for_visitor(): void
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');

        $this->assertPageTitleContains('Log in!');
    }

    /** @test */
    public function a_visitor_with_wrong_credentials_cant_logged_in(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('Sign in')->form();
        $form['email'] = 'fake-user@example.com';
        $form['password'] = 'password';
        $crawler = $client->submit($form);
        $crawler = $client->followRedirect();

        $this->assertPageTitleContains('Log in!');
        $this->assertTrue($crawler->filter('html:contains("Email could not be found.")')->count() > 0);
    }

    /** @test */
    public function a_visitor_with_credentials_can_logged_in(): void
    {
        self::markTestIncomplete('No Fixture. TODO Populate database with user');
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('Sign in')->form();
        $form['email'] = 'admin@example.com';
        $form['password'] = 'admin';
        $crawler = $client->submit($form);
        $crawler = $client->followRedirect();

        $this->assertTrue($client->getResponse()->isRedirect(), 'Error: No redirect after login form.');
        $this->assertTrue($crawler->filter('html:contains("Account")')->count() > 0);
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
