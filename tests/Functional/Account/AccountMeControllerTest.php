<?php

declare(strict_types=1);

namespace App\Tests\Functional\Account;

use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Panther\PantherTestCase;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class AccountMeControllerTest extends PantherTestCase
{
    /** @var mixed */
    private $client = null;

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    /** @test */
    public function a_visitor_cant_show_user_account_page(): void
    {
        $crawler = $this->client->request('GET', '/account/me/');
        $this->assertSame(Response::HTTP_FOUND, $this->client->getResponse()->getStatusCode());
        $this->assertTrue($this->client->getResponse()->isRedirect());
        $this->client->followRedirect();
        $this->assertContains(
            'Login',
            $this->client->getResponse()->getContent()
        );
    }

    /** @test */
    public function a_user_can_show__account_page(): void
    {
        self::markTestIncomplete('populate database before');
        $this->logInAsAdminUser();
        $crawler = $this->client->request('GET', '/account/me/');
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertContains(
            'My Account',
            $this->client->getResponse()->getContent()
        );
    }

    private function logInAsAdminUser(): void
    {
        $session = $this->client->getContainer()->get('session');

        $firewallName = 'test_main';
        // if you don't define multiple connected firewalls, the context defaults to the firewall name
        // See https://symfony.com/doc/current/reference/configuration/security.html#firewall-context
        $firewallContext = 'test_main';

        // you may need to use a different token class depending on your application.
        // for example, when using Guard authentication you must instantiate PostAuthenticationGuardToken
        $token = new UsernamePasswordToken('admin@example.com', null, $firewallName, ['ROLE_ADMIN']);
        $session->set('_security_'.$firewallContext, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }
}
