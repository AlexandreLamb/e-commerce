<?php

namespace App\Controller;

use App\Entity\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
    
    /**
     * @Route("/register/user", methods={"POST"}, name="register_user")
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder)
        {
            $data = json_decode($request->getContent(),true);
            $user = new User();
            $password = password_hash($data['password'],PASSWORD_BCRYPT);  
                $user->setEmail($data['email']);
                $user->setUsername($data['username']);
                $user->setPassword($password);
                $user->setPainPassword($password);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            return new Response('new user '. $user->getUserName());
    }

    /**
     * @Route("/check/user/mail", methods={"POST"}, name="check_user_mail")
     */
        public function checkUserMail(Request $request){
            $data = json_decode($request->getContent(),true);
            $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['email' => $data['email']]);

    if (!$user) {
        return new Response('true');
    }

    return new Response('false');

        }
        /**
         * @Route("/check/user", methods={"POST"}, name="check_user")
         */
    public function checkUser (Request $request) {
        $data = json_decode($request->getContent(),true);
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['email' => $data['email']]);
            if (!$user){
                return new Response('false');
            } else {
                if (  password_verify($data['password'],$user->getPassword() ) ) {
                    return new response('true');
                }   
            }
    }
}
