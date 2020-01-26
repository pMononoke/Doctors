<?php

namespace App\Controller\Admin;

use App\Entity\Patient;
use App\Entity\PatientRepository;
use App\Form\Patient\Dto\PatientPersonalDataDTO;
use App\Form\Patient\Dto\RegisterPatientDTO;
use App\Form\Patient\PatientPersonalDataType;
use App\Form\Patient\RegisterPatientType;
use App\Service\PatientService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
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
    public function index(PatientRepository $patientRepository): Response
    {
        return $this->render('admin/patient/index.html.twig', [
            'patients' => $patientRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_patient_new", methods={"GET","POST"})
     */
    public function new(Request $request, PatientService $patientSevice): Response
    {
        $registerPatientDTO = new RegisterPatientDTO();
        $form = $this->createForm(RegisterPatientType::class, $registerPatientDTO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newIdentity = $patientSevice->generateNewIdentity();
            $patientSevice->RegisterPatientWithData($newIdentity, $registerPatientDTO);
            $this->addFlash(
                'success',
                'flash.patient.was.created'
            );

            return $this->redirectToRoute('admin_patient_index');
        }

        return $this->render('admin/patient/new.html.twig', [
            'patient' => $registerPatientDTO,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_patient_show", methods={"GET"})
     * @Entity("patient", expr="repository.findByUuidString(id)")
     */
    public function show(Patient $patient): Response
    {
        return $this->render('admin/patient/show.html.twig', [
            'patient' => $patient,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_patient_edit", methods={"GET","POST"})
     * @Entity("patient", expr="repository.findByUuidString(id)")
     */
    public function edit(Request $request, PatientService $patientService, Patient $patient): Response
    {
        $patientPersonalDataDTO = PatientPersonalDataDTO::fromPatient($patient);
        $form = $this->createForm(PatientPersonalDataType::class, $patientPersonalDataDTO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // form is valid, update the patient entity with the new data from dto
            $patient->setFirstname($patientPersonalDataDTO->firstName);
            null === $patientPersonalDataDTO->middleName ? $patient->setMiddleName('') : $patient->setMiddleName($patientPersonalDataDTO->middleName);
            $patient->setLastName($patientPersonalDataDTO->lastName);
            $patient->setGender($patientPersonalDataDTO->gender);
            $patient->setDateOfBirth($patientPersonalDataDTO->dateOfBirth);
            $patientService->update($patient);
            $this->addFlash(
                'success',
                'flash.patient.changes.was.saved'
            );

            return $this->redirectToRoute('admin_patient_index');
        }

        return $this->render('admin/patient/edit.html.twig', [
            'patient' => $patient,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_patient_delete", methods={"DELETE"})
     * @Entity("patient", expr="repository.findByUuidString(id)")
     */
    public function delete(Request $request, PatientService $patientService, Patient $patient): Response
    {
        if ($this->isCsrfTokenValid('delete'.$patient->getId(), $request->request->get('_token'))) {
            $patientService->delete($patient);
            $this->addFlash(
                'success',
                'flash.patient.was.deleted'
            );
        }

        return $this->redirectToRoute('admin_patient_index');
    }
}
