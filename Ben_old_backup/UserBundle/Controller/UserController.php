<?php

namespace Ben\UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function loginFbAction()
    {
        return $this->redirect($this->generateUrl('home'));
    }

    /**
     * @Template()
     */
    public function whoIsOnlineAction()
    {
        $users = $this->getDoctrine()->getManager()->getRepository('BenUserBundle:User')->getActive();

        return ['users' => $users];
    }

    /**
     * user json list.
     */
    public function autocompleteAction()
    {
        $request = $this->get('request');
        $keyword = $request->get('term');
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('BenUserBundle:User')->autocomplete($keyword);

        return $this->render('BenUserBundle:User:autocomplete.json.twig', [
                    'entities' => $entities,
                ]);
    }
}
