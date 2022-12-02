<?php
namespace App\Service;



class UserManager
{
    public function createUser($username,$password) {

       
    
        $user = new User();
    
        /*$encoder = $factory->getEncoder($user);
        $user->setSalt(md5(time()));
        $pass = $encoder->encodePassword($password, $user->getSalt());*/
        $user->setUsername($username);
        $user->setPassword($pass);
    
        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($user);
        $em->flush();
    
        return new Response('Sucessful'); 
    }
}