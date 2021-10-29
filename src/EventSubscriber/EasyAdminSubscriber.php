<?php

namespace App\EventSubscriber;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelInterface;

class EasyAdminSubscriber implements EventSubscriberInterface {

    private $appKernel;

    public function __construct(KernelInterface $appKernel)
    {
        $this->appKernel = $appKernel;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setIllustration'],
            BeforeEntityUpdatedEvent::class => ['updateIllustration']
        ];
    }

    public function uploadIllustration ($event) {
        $entity = $event->getEntityInstance();
        $tmp_name = $_FILES['Product']['tmp_name']['illustration'];

        $extension = pathinfo($_FILES['Product']['name']['illustration'],  PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $extension;

        move_uploaded_file($tmp_name, $this->appKernel->getProjectDir() . '/public/uploads/' . $filename);

        $entity->setIllustration($filename);
    }

    public function updateIllustration(BeforeEntityUpdatedEvent $event) {

        if(!$event->getEntityInstance() instanceof Product) {
            return;
        }

        if($_FILES['Product']['tmp_name']['illustration'] != '') {
            $this->uploadIllustration($event);
        }
    }

    public function setIllustration(BeforeEntityPersistedEvent $event) {

        if(!$event->getEntityInstance() instanceof Product) {
            return;
        }

        $this->uploadIllustration($event);
    }
}
