<?php

namespace Ben\UserBundle\Listener;

use Ben\BlogBundle\Entity\newsletter;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Listener responsible to change the redirection at the end of the password resetting.
 */
class registerListener implements EventSubscriberInterface
{
    protected $context;
    protected $em;

    public function __construct(SecurityContext $context, EntityManager $em)
    {
        $this->context = $context;
        $this->em = $em;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            FOSUserEvents::RESETTING_RESET_SUCCESS => 'onRegistrationCompleted',
        ];
    }

    public function onRegistrationCompleted(FilterUserResponseEvent $event)
    {
        $user = $event->getAuthenticationToken()->getUser();
        $entity = new newsletter();
        $entity->setName($user->getUsername());
        $entity->setEmail($user->getEmail());
        $entity->setStatus(true);
        $this->em->persist($entity);
        $this->em->flush($entity);
    }
}
