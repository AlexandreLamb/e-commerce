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
     * @Route("/register/product", name="product")
     */
    public function product()
    {
        
        $entityManager = $this->getDoctrine()->getManager();

        $product = new Product();
        $product->setName('Keyboard');
        $product->setPrice(1999);
        $product->setDescription('Ergonomic and stylish!');

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id ' .$product->getId());
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
}
