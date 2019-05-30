<?php

namespace App\EventSubscriber;

use App\Entity\User;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserRegisterSubscriber implements EventSubscriber
{
    private  $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function getSubscribedEvents()
    {

        return ['prePersist'];

    }

    public function prePersist(LifecycleEventArgs $args ){
        $this->encodePassword($args);
        $this->setCreatedAt($args);
        $this->setUserRoles($args);
    }

    private function encodePassword(LifecycleEventArgs $args )
    {

        $user = $args->getObject();
        if ($user instanceof User) {
            $encoded = $this->encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encoded);
        }
    }

    private function setCreatedAt(LifecycleEventArgs $args ){
        $user = $args->getObject();
        if ($user instanceof User) {
            $user->setCreatedAt(new \DateTime());
        }
    }

    private function setUserRoles(LifecycleEventArgs $args ){
       /* $user = $args->getObject();
        if ($user instanceof User) {
            $user->setRoles(["ROLE_USER"]);
        }
       */
    }


}