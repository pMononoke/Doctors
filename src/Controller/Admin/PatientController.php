<?php

namespace App\Controller\Admin;

use App\Dto\PatientPersonalDataDTO;
use App\Dto\RegisterPatientDTO;
use App\Entity\Person;
use App\Form\PatientPersonalDataFormDTOType;
use App\Form\RegisterPatientType;
use App\Repository\PersonRepository;
use App\Service\PatientService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/patient")
 */
class PatientController extends AbstractController
{
    /**
     * @Route("/", name="admin_patient_index", methods={"GET"})
     */
    public function index(PersonRepository $patientRepository): Response
    {
        return $this->render('admin/patient/index.html.twig', [
            'people' => $patientRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_patient_new", methods={"GET","POST"})
     */
    public function new(Request $request, PatientService $patientSevice): Response
    {
        // create an empty instance of an RegisterPatientDTO
        $registerPatientDTO = new RegisterPatientDTO();
        $form = $this->createForm(RegisterPatientType::class, $registerPatientDTO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // get personal data dto from form
            $patientPersonalDataDTO = $registerPatientDTO->patientPersonalData;

            // form is valid, transform from dto to entity
            $patient = new Person();
            $patient->setFirstname($patientPersonalDataDTO->firstName);
            $patient->setFamilyname($patientPersonalDataDTO->lastName);
            $patient->setBirthday(new \DateTime('now'));
            $patientSevice->RegisterPatient($patient);

            return $this->redirectToRoute('admin_patient_index');
        }

        return $this->render('admin/patient/new.html.twig', [
            'patient' => $registerPatientDTO,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_patient_show", methods={"GET"})
     */
    public function show(Person $patient): Response
    {
        return $this->render('admin/patient/show.html.twig', [
            'patient' => $patient,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_patient_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PatientService $patientService, Person $patient): Response
    {
        $patientPersonalDataDTO = PatientPersonalDataDTO::fromPatient($patient);
        $form = $this->createForm(PatientPersonalDataFormDTOType::class, $patientPersonalDataDTO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // form is valid, update the patient entity with the new data from dto
            $patient = new Person();
            $patient->setFirstname($patientPersonalDataDTO->firstName);
            $patient->setFamilyname($patientPersonalDataDTO->lastName);
            $patient->setBirthday($patientPersonalDataDTO->dateOfBirthday);
            $patientService->update($patient);

            return $this->redirectToRoute('admin_patient_index');
        }

        return $this->render('admin/patient/edit.html.twig', [
            'patient' => $patient,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_patient_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Person $patient): Response
    {
        if ($this->isCsrfTokenValid('delete'.$patient->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($patient);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_patient_index');
    }
}
