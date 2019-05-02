<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Product;
use App\Entity\CarteBleu;

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
use Symfony\Component\Validator\Constraints\DateTimeInterface;

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
                $user-> setUserlastname($data['userlastname']);
                $user->setEmail($data['email']);
                $user->setUsername($data['username']);
                $user->setPassword($password);
                $user->setPainPassword($password);
                $user-> setTelephone($data['telephone']);
                $user-> setAdresse($data['adresse']);
                $user-> setVille($data['ville']);
                $user-> setDateNaissance(NULL);
                $user->setPays($data['pays']);
                $user->setCodePostale($data['codePostale']);


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);

            $cb = new CarteBleu();
            $cb->setNumero($data['numero']);
            $cb->setType($data['typeCb']);
            $cb->setDateValidite($data['dateValidite']);
            $cb->setCrypto($data['crypto']);
            $cb->setUser($user);
            $entityManager->persist($cb);

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
                    $user = $this->getDoctrine()
                     ->getRepository(User::class)
                    ->findOneUser($data['email']);
                    $jsonContent = $this->serializer->serialize($user, 'json');
                    return new Response($jsonContent);
                }   
            }
            return new Response('false');
    }
        /**
         * @Route("/add/product/panier", methods={"POST"}, name="add_product_panier")
         */
        public function addPanier (Request $request) {
            $data = json_decode($request->getContent(),true);

            $product = $this->getDoctrine()
                ->getRepository(Product::class)
                ->findOneBy(['id' => $data['productId']]);

            $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy(['id' => $data['userId']]);
            
                if (!$product && !$user){
                    return new Response('false');
                } else {
                   $user->addPanier($product);
                   $entityManager = $this->getDoctrine()->getManager();
                   $entityManager->persist($user);
                   $entityManager->flush();
                   $jsonContent = $this->serializer->serialize($user, 'json');
                   return new Response($jsonContent);                
                }
                return new Response('false');
        }
        
    /**
     * @Route("/get/users", methods={"GET"}, name="get_users")
     */
    public function getUsers(){
        $entityManager = $this->getDoctrine()->getManager();
        $users = $this->getDoctrine()
        ->getRepository(User::class)
        ->findAllUsers();
        $jsonContent = $this->serializer->serialize($users, 'json');
        return new Response($jsonContent);
    }
    /**
     * @Route("/update/user", methods={"POST"}, name="update_user")
     */
    public function update(Request $request)
        {
            $data = json_decode($request->getContent(),true);
            
            $entityManager = $this->getDoctrine()->getManager();
            $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($data['userId']);


                $user-> setUserlastname($data['userlastname']);
                $user->setEmail($data['email']);
                $user->setUsername($data['username']);
                $user-> setTelephone($data['telephone']);
                $user-> setAdresse($data['adresse']);
                $user-> setVille($data['ville']);
                $user-> setDateNaissance(NULL);


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $jsonContent = $this->serializer->serialize($user, 'json');
            return new Response($jsonContent);

        }

    /**
     * @Route("/get/panier/user/{id}", methods={"GET"}, name="get_users_panier")
     */
    public function getPanier(Int $id){
        $entityManager = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy(['id' => $id]);
        $panier= $this->getDoctrine()
        ->getRepository(Product::class)
        ->findPanier($id);
        
        $jsonContent = $this->serializer->serialize($panier, 'json');
        return new Response($jsonContent);
    }
        /**
         * @Route("/delete/product/panier", methods={"POST"}, name="delete_product_panier")
         */
        public function deletePanier (Request $request) {
            $data = json_decode($request->getContent(),true);
            $entityManager = $this->getDoctrine()->getManager();

            $product = $this->getDoctrine()
                ->getRepository(Product::class)
                ->findOneBy(['id' => $data['productId']]);

            $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy(['id' => $data['userId']]);
            
                if (!$product && !$user){
                    return new Response('false');
                } else {
                   $user->removePanier($product);
                   $entityManager->persist($user);
                   $entityManager->flush();
                   $panier = $this->getDoctrine()->getRepository(Product::class)
                   ->findPanier($data['userId']);

                   $jsonContent = $this->serializer->serialize($panier, 'json');
                   return new Response($jsonContent);                
                }
                return new Response('false');
        }

        /**
         * @Route("/delete/product/ventes", methods={"POST"}, name="delete_product_ventes")
         */
        public function deleteVentes (Request $request) {
            $data = json_decode($request->getContent(),true);
            $entityManager = $this->getDoctrine()->getManager();

            $product = $this->getDoctrine()
                ->getRepository(Product::class)
                ->findOneBy(['id' => $data['productId']]);

            $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy(['id' => $data['userId']]);
            
                if (!$product && !$user){
                    return new Response('false');
                } else {
                   $user->removeProduct($product);
                   $entityManager->persist($user);
                   $entityManager->flush();
                   $ventes = $this->getDoctrine()->getRepository(Product::class)
                   ->findVendeur($data['userId']);

                   $jsonContent = $this->serializer->serialize($ventes, 'json');
                   return new Response($jsonContent);                
                }
                return new Response('false');
        }
   /**
    * @Route("/get/vente/user/{id}", methods={"GET"}, name="get_users_vente")
    */
    public function getVente(Int $id){
        $entityManager = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy(['id' => $id]);
        $vendeur= $this->getDoctrine()
        ->getRepository(Product::class)
        ->findVendeur($id);
        
        $jsonContent = $this->serializer->serialize($vendeur, 'json');
        return new Response($jsonContent);
    }
    
}
 