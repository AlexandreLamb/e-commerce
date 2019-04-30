<?php

namespace App\Controller;
use App\Entity\Product;
use App\Entity\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class ProductController extends AbstractController
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
     * @Route("/add/product", methods={"POST"}, name="add_product")
     */
    public function product(Request $request)
    {
        $data = json_decode($request->getContent(),true);

        $entityManager = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine()
        ->getRepository(User::class)    
        ->find($data['userId']);


        $product = new Product();
        $product->setName($data['name']);
        $product->setPrice($data['price']);
        $product->setDescription($data['description']);
        $product->setCategorie($data['categorie']);
        $product->setNbrVentes(0);
        $product->setVendeur($user);
        $product->setImg($data['img']);
        


        $entityManager->persist($product);
        $entityManager->flush();

        return new Response("product add");
    }

    /**
     * @Route("/get/products", methods={"GET"}, name="get_products")
     */
    public function getProducts(){
        $entityManager = $this->getDoctrine()->getManager();
        $products = $this->getDoctrine()
        ->getRepository(Product::class)
        ->findAll();

        $jsonContent = $this->serializer->serialize($products, 'json');
        return new Response($jsonContent);
    }
    
    /**
     * @Route("/search/products/{name}", methods={"GET"}, name="search_products")
     */
    public function searchProduct(String $name){
        $entityManager = $this->getDoctrine()->getManager();
        $products = $this->getDoctrine()
        ->getRepository(Product::class)
        ->findByLetter($name);

        $jsonContent = $this->serializer->serialize($products, 'json');
        return new Response($jsonContent);
    }

    /**
     * @Route("/get/products/{categories}", methods={"GET"}, name="get_products_categorie")
     */
    public function getProductsCategorie(String $categories){

        $entityManager = $this->getDoctrine()->getManager();
        $products = $this->getDoctrine()
        ->getRepository(Product::class)
        ->findBy(['categorie' => $categories]);
        $jsonContent = $this->serializer->serialize($products, 'json');
        return new Response($jsonContent);
    }
    
}
