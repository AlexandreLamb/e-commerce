<?php

namespace App\Controller;

use App\Entity\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


class UserController extends AbstractController
{
    private $encoders ;
    private $normalizers;
    private $serializer;
    public function __construct()
    {   
        $this->encoder = new JsonEncoder();

        $this->normalizer = new ObjectNormalizer();
        $this->normalizer->setIgnoredAttributes(array('password', 'histories', 'wikies', 'documents', 'files', 'articles', 'salt', 'credentialsNonExpired', 'events'));
        $this->normalizer->setCircularReferenceHandler(function ($object, string $format = null, array $context = array()) {
            return $object->getId();
        });
        $this->serializer = new Serializer(array($this->normalizer), array($this->encoder));
       
    }
    
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
            $repository = $this->getDoctrine()->getRepository(User::class);
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
     * @Route("/get/users", methods={"GET"}, name="get_users")
     */
    public function getProducts(){
        $entityManager = $this->getDoctrine()->getManager();
        $users = $this->getDoctrine()
        ->getRepository(User::class)
        ->findAll();
        $jsonContent = $this->serializer->serialize($users, 'json');
        return new Response($jsonContent);
    }
    
}
