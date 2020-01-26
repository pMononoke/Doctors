<?php

namespace App\Tests\Functional\Admin;

use App\Entity\Patient;
use App\Repository\PatientRepository;
use App\Tests\Support\Builder\PatientBuilder;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Panther\PantherTestCase;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class PatientControllerTest extends PantherTestCase
{
    private const PATIENT_FIRST_NAME = 'Mario';
    private const PATIENT_MIDDLE_NAME = 'Alberto';
    private const PATIENT_LAST_NAME = 'Alberto';
    private const PATIENT_GENDER = 'male';
    private const PATIENT_GENDER_MALE = 'male';
    private const PATIENT_GENDER_FEMALE = 'female';
    private const PATIENT_DATE_OF_BIRTH = '1950-01-01';
    private const FORM_VALUE_GENDER_MALE = 1; // VALUE DEFINED IN CHOICE FORM FIELD
    private const FORM_VALUE_GENDER_FEMALE = 2; // VALUE DEFINED IN CHOICE FORM FIELD

    /** @var mixed */
    private $client = null;

    /** @var PatientRepository|mixed */
    private $patientRepository;

    public function setUp(): void
    {
        $this->client = static::createClient();
        $this->patientRepository = self::$container->get('test.App\Repository\PatientRepository');
    }

    /** @test */
    public function admin_can_access_patient_index_page(): void
    {
        $patient = $this->generateApatient();
        $this->populateDatabase($patient);

        $this->logInAsAdminUser();
        $crawler = $this->client->request('GET', '/admin/patient/');

        self::assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        self::assertSelectorTextContains('html', self::PATIENT_FIRST_NAME);
        self::assertSelectorTextContains('html', self::PATIENT_MIDDLE_NAME);
        self::assertSelectorTextContains('html', self::PATIENT_GENDER);
        self::assertSelectorTextContains('html', self::PATIENT_DATE_OF_BIRTH);
    }

    /** @test */
    public function can_create_a_new_patient(): void
    {
        $this->logInAsAdminUser();
        $crawler = $this->client->request('GET', '/admin/patient/new');

        self::assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        self::assertContains(
            'patient.new_header',
            $this->client->getResponse()->getContent()
        );

        $form = $crawler->selectButton('common.actions.save')->form();
        $form['register_patient[patientPersonalData][firstName]'] = self::PATIENT_FIRST_NAME;
        $form['register_patient[patientPersonalData][middleName]'] = self::PATIENT_MIDDLE_NAME;
        $form['register_patient[patientPersonalData][lastName]'] = self::PATIENT_LAST_NAME;
        $form['register_patient[patientPersonalData][gender]'] = self::FORM_VALUE_GENDER_MALE;
        $dateOfBirth = new \DateTimeImmutable(self::PATIENT_DATE_OF_BIRTH);
        $form['register_patient[patientPersonalData][dateOfBirth][year]'] = (int) $dateOfBirth->format('Y');
        $form['register_patient[patientPersonalData][dateOfBirth][month]'] = (int) $dateOfBirth->format('m');
        $form['register_patient[patientPersonalData][dateOfBirth][day]'] = (int) $dateOfBirth->format('d');

        $crawler = $this->client->submit($form);

        self::assertTrue($this->client->getResponse()->isRedirect());

        $this->client->followRedirect();

        self::assertFlashMessage(
            'flash.patient.was.created',
            $this->client->getResponse()->getContent()
        );
        self::assertContains(
            'patient.index_header',
            $this->client->getResponse()->getContent()
        );
        self::assertSelectorTextContains('html', self::PATIENT_FIRST_NAME);
        self::assertSelectorTextContains('html', self::PATIENT_MIDDLE_NAME);
        self::assertSelectorTextContains('html', self::PATIENT_GENDER);
        self::assertSelectorTextContains('html', self::PATIENT_DATE_OF_BIRTH);
    }

    /** @test */
    public function can_show_a_patient_detail_page(): void
    {
        $this->populateDatabase($patient = $this->generateApatient());
        $this->logInAsAdminUser();

        $crawler = $this->client->request('GET', '/admin/patient/'.$patient->getId()->toString());

        self::assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        self::assertSelectorTextContains('html', self::PATIENT_FIRST_NAME);
        self::assertSelectorTextContains('html', self::PATIENT_MIDDLE_NAME);
        self::assertSelectorTextContains('html', self::PATIENT_GENDER);
        self::assertSelectorTextContains('html', self::PATIENT_DATE_OF_BIRTH);
    }

    /** @test */
    public function can_edit_a_patient(): void
    {
        $newFirstName = 'Kat';
        $newMiddleName = 'Mary';
        $newLastName = 'Dumars';
        $newGender = 'female';
        $newDateOfBirth = new \DateTimeImmutable('now');
        $this->populateDatabase($patient = $this->generateApatient());
        $this->logInAsAdminUser();

        $crawler = $this->client->request('GET', '/admin/patient/'.$patient->getId()->toString().'/edit');

        self::assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        self::assertContains(
            'patient.edit_header',
            $this->client->getResponse()->getContent()
        );

        $form = $crawler->selectButton('Update')->form();
        $form['patient_personal_data[firstName]'] = $newFirstName;
        $form['patient_personal_data[middleName]'] = $newMiddleName;
        $form['patient_personal_data[lastName]'] = $newLastName;
        $form['patient_personal_data[gender]'] = self::FORM_VALUE_GENDER_FEMALE;
        $form['patient_personal_data[dateOfBirth][year]'] = (int) $newDateOfBirth->format('Y');
        $form['patient_personal_data[dateOfBirth][month]'] = (int) $newDateOfBirth->format('m');
        $form['patient_personal_data[dateOfBirth][day]'] = (int) $newDateOfBirth->format('d');
        $crawler = $this->client->submit($form);
        $this->client->followRedirect();

        self::assertContains(
            'patient.index_header',
            $this->client->getResponse()->getContent()
        );
        self::assertFlashMessage(
            'flash.patient.changes.was.saved',
            $this->client->getResponse()->getContent()
        );
        self::assertSelectorTextContains('html', $newFirstName);
        self::assertSelectorTextContains('html', $newMiddleName);
        self::assertSelectorTextContains('html', $newLastName);
        self::assertSelectorTextContains('html', self::PATIENT_GENDER_FEMALE);
        self::assertSelectorTextContains('html', $newDateOfBirth->format('Y-m-d'));
    }

    /** @test */
    public function can_delete_a_patient(): void
    {
        $this->populateDatabase($patient = $this->generateApatient());
        $this->logInAsAdminUser();

        $crawler = $this->client->request('GET', '/admin/patient/'.$patient->getId()->toString());

        self::assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        self::assertContains(
            'patient.show_header',
            $this->client->getResponse()->getContent()
        );
        // check if there are multiple button
        self::assertEquals(
            1,
            $crawler->filter('html:contains("common.actions.delete")')->count()
        );

        // Click on button delete
        $buttonCrawlerNode = $crawler->selectButton('common.actions.delete');
        $form = $buttonCrawlerNode->form([]);
        $this->client->submit($form);
        $this->client->followRedirect();

        self::assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        self::assertFlashMessage(
            'flash.patient.was.deleted',
            $this->client->getResponse()->getContent()
        );
        self::assertContains(
            'patient.index_header',
            $this->client->getResponse()->getContent()
        );
        self::assertContains(
            'common.no_record_found',
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

    protected function populateDatabase(Patient $object): void
    {
        $this->persistData($object);
    }

    protected function persistData(Patient $object): void
    {
        $this->patientRepository->save($object);
    }

    private function generateApatient(): Patient
    {
        $patientBuilder = PatientBuilder::create();

        $patient = $patientBuilder
            ->withFirstName(self::PATIENT_FIRST_NAME)
            ->withMiddleName(self::PATIENT_MIDDLE_NAME)
            ->withLastName(self::PATIENT_LAST_NAME)
            ->withGender(self::PATIENT_GENDER)
            ->withDateOfBirth(new \DateTimeImmutable(self::PATIENT_DATE_OF_BIRTH))
            ->build()
            ;

        return $patient;
    }

    private static function assertFlashMessage(string $message, string $htmlCode): void
    {
        self::assertContains(
            $message,
            $htmlCode,
            'Flash message don\'t contain '.$message
        );
    }
}
