<?php

namespace App\Tests\Functional\Admin;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Panther\PantherTestCase;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class UserControllerTest extends PantherTestCase
{
    /** @var mixed */
    private $client = null;

    /** @var UserRepository|mixed */
    private $userRepository;

    public function setUp(): void
    {
        $this->client = static::createClient();
        $this->userRepository = self::$container->get('test.App\Repository\UserRepository');
    }

    /** @test */
    public function admin_can_access_user_index(): void
    {
        $this->logIn();
        $crawler = $this->client->request('GET', '/admin/user/');

        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    /** @test */
    public function can_create_a_new_user(): void
    {
        $this->logIn();
        $crawler = $this->client->request('GET', '/admin/user/new');
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());

        $form = $crawler->selectButton('common.actions.save')->form();
        $form['register_user[user][email]'] = 'fake-user@example.com';
        $form['register_user[profile][firstName]'] = 'xxxxxxxxxxx';
        $form['register_user[profile][lastName]'] = 'xxxxxxxxxxx';
        $form['register_user[user][accountStatus]'] = true;

        $crawler = $this->client->submit($form);
        $this->assertTrue($this->client->getResponse()->isRedirect());
        $this->client->followRedirect();

        $this->assertContains(
            'fake-user@example.com',
            $this->client->getResponse()->getContent()
        );

        //$this->assertSame(self::$baseUri.'/admin/user/', $this->client->getCurrentURL());
        //self::assertPageTitleSame('User Index');
    }

    /** @test */
    public function can_show_a_user_detail_page(): void
    {
        self::markTestIncomplete('First define UI elements');
        $this->logIn();
    }

    /** @test */
    public function can_edit_a_user(): void
    {
        $this->populateDatabase($user = $this->generateAuser());

        $this->logIn();
        $crawler = $this->client->request('GET', '/admin/user/'.$user->getId().'/edit');
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertContains(
            'user.edit_header',
            $this->client->getResponse()->getContent()
        );
        $form = $crawler->selectButton('Update')->form();
        $form['user[email]'] = 'new@example.com';
        $form['user[accountStatus]'] = '0';
        $crawler = $this->client->submit($form);
        $this->client->followRedirect();

        // go to show page
        $crawler = $this->client->request('GET', '/admin/user/'.$user->getId());
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertContains(
            'user.show_header',
            $this->client->getResponse()->getContent()
        );
        $this->assertContains(
            'new@example.com',
            $this->client->getResponse()->getContent()
        );
        $this->assertContains(
            'user.account_status.disabled',
            $this->client->getResponse()->getContent()
        );
        //$this->assertSame(self::$baseUri.'/admin/user/', $this->client->getCurrentURL());
        //self::assertPageTitleSame('User Index');
    }

    /** @test */
    public function can_delete_a_user(): void
    {
        $this->populateDatabase($user = $this->generateAuser());
        $this->logIn();

        //Go to user list page
        $crawler = $this->client->request('GET', '/admin/user/'.$user->getId()->toString());
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertContains(
            'user.show_header',
            $this->client->getResponse()->getContent()
        );

        // check if there are multiple button
        $this->assertEquals(
            1,
            $crawler->filter('html:contains("common.actions.delete")')->count()
        );
        // Click on button delete

        $buttonCrawlerNode = $crawler->selectButton('common.actions.delete');
        $form = $buttonCrawlerNode->form([]);
        $this->client->submit($form);
        $this->client->followRedirect();

        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertContains(
            'user.index_header',
            $this->client->getResponse()->getContent()
        );
        $this->assertNotContains(
            $user->getId()->toString(),
            $this->client->getResponse()->getContent()
        );
        $this->assertNotContains(
            $user->getEmail(),
            $this->client->getResponse()->getContent()
        );
    }

    /** @test */
    public function can_enable_a_user_account(): void
    {
        $this->populateDatabase($user = $this->generateDisabledUser());
        $this->logIn();

        //Go to user show page
        $crawler = $this->client->request('GET', '/admin/user/'.$user->getId()->toString());
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertContains(
            'user.show_header',
            $this->client->getResponse()->getContent()
        );
        $this->assertContains(
            'user.account_status.disabled',
            $this->client->getResponse()->getContent()
        );

        // check if there one button "enable account"
        $this->assertEquals(
            1,
            $crawler->filter('html:contains("user.actions.enable_account")')->count()
        );

        // Click on button "enable account"
        $buttonCrawlerNode = $crawler->selectButton('user.actions.enable_account');
        $form = $buttonCrawlerNode->form([]);
        $this->client->submit($form);
        $this->client->followRedirect();

        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertContains(
            'user.index_header',
            $this->client->getResponse()->getContent()
        );

        //Go to user show page
        $crawler = $this->client->request('GET', '/admin/user/'.$user->getId()->toString());
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertContains(
            'user.show_header',
            $this->client->getResponse()->getContent()
        );
        // check if there one string "account enable"
        $this->assertEquals(
            1,
            $crawler->filter('html:contains("user.account_status.enabled")')->count()
        );
    }

    /** @test */
    public function can_disable_a_user_account(): void
    {
        $this->populateDatabase($user = $this->generateAuser());
        $this->logIn();

        //Go to user show page
        $crawler = $this->client->request('GET', '/admin/user/'.$user->getId()->toString());
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertContains(
            'user.show_header',
            $this->client->getResponse()->getContent()
        );
        $this->assertContains(
            'user.account_status.enabled',
            $this->client->getResponse()->getContent()
        );

        // check if there one button "disable account"
        $this->assertEquals(
            1,
            $crawler->filter('html:contains("user.actions.disable_account")')->count()
        );

        // Click on button disable account
        $buttonCrawlerNode = $crawler->selectButton('user.actions.disable_account');
        $form = $buttonCrawlerNode->form([]);
        $this->client->submit($form);
        $this->client->followRedirect();

        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertContains(
            'user.index_header',
            $this->client->getResponse()->getContent()
        );

        //Go to user show page
        $crawler = $this->client->request('GET', '/admin/user/'.$user->getId()->toString());
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertContains(
            'user.show_header',
            $this->client->getResponse()->getContent()
        );
        // check if there one string "account disabled"
        $this->assertEquals(
            1,
            $crawler->filter('html:contains("user.account_status.disabled")')->count()
        );
    }

    private function logIn(): void
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

    protected function populateDatabase(User $object): void
    {
        $this->persistData($object);
    }

    protected function persistData(User $object): void
    {
        $this->userRepository->save($object);
    }

    private function generateAuser(): User
    {
        $user = new User();
        $user->setEmail('irrelevant@example.com');
        $user->setPassword('irrelevant');
        $user->setRoles(['ROLE_USER']);
        $user->setAccountStatus(true);

        return $user;
    }

    private function generateDisabledUser(): User
    {
        $user = $this->generateAuser();
        $user->setAccountStatus(false);

        return $user;
    }
}
