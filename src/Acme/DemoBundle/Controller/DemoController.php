<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Acme\DemoBundle\Form\ContactType;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Acme\DemoBundle\Entity\User;
use Acme\DemoBundle\Entity\Address;

class DemoController extends Controller
{
    /**
     * @Route("/", name="_demo")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        
//        $user = new User('njcalugar with address', '12345678');
//        $address = new Address($user, '125 Gilbert St');
//        $user->addAddress($address);
//        $em->persist($user);
//        $em->persist($address);

//        $user = $em->find('Acme\DemoBundle\Entity\User', 2);
//        
//        echo $user->getName();
//        
//        $repo = $em->getRepository('Acme\DemoBundle\Entity\User');
//        
//        $user = $repo->find('1');
//        
//        echo $user->getName();
//        
//        $user = $repo->findOneBy(array('name'=>'njcalugar'));
//        
//        echo $user->getName();
        
//        $user = $em->createQuery('SELECT u FROM Acme\DemoBundle\Entity\User u WHERE LENGTH (u.name) > 5');
//        
//        echo '<br />';
//        
//        foreach ($user->getResult() as $user) {
//            echo $user->getName() . ' | ' . count($user->getAddresses()) . "<br />";
//            $address = new Address($user, uniqid());
//            $user->addAddress($address);
//            $em->persist($address);
//        }

        
        
        $em->flush();
        
        return array('msg' => 'test');
    }

    /**
     * @Route("/hello/{name}", name="_demo_hello")
     * @Template()
     */
    public function helloAction($name)
    {
        return array('name' => $name);
    }

    /**
     * @Route("/contact", name="_demo_contact")
     * @Template()
     */
    public function contactAction()
    {
        $form = $this->get('form.factory')->create(new ContactType());

        $request = $this->get('request');
        if ('POST' == $request->getMethod()) {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $mailer = $this->get('mailer');
                // .. setup a message and send it
                // http://symfony.com/doc/current/cookbook/email.html

                $this->get('session')->setFlash('notice', 'Message sent!');

                return new RedirectResponse($this->generateUrl('_demo'));
            }
        }

        return array('form' => $form->createView());
    }
}
