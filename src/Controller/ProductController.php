<?php

namespace App\Controller;
use App\Entity\Product;
use App\Entity\User;
use App\Entity\Attachments;

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

        $attachment1 = new Attachments();
        $entityManager->persist($attachment1);
        $attachment1->setFilename($data['img1']);

        $attachment2 = new Attachments();
        $entityManager->persist($attachment2);
        $attachment2->setFilename($data['img2']);

        $attachment3 = new Attachments();
        $entityManager->persist($attachment3);
        $attachment3->setFilename($data['img3']);

        $product = new Product();
        $product->setName($data['name']);
        $product->setPrice($data['price']);
        $product->setDescription($data['description']);
        $product->setCategorie($data['categorie']);
        $product->setNbrVentes(0);
        $product->setVendeur($user);
        $product->addAttachment($attachment1);
        $product->addAttachment($attachment2);
        $product->addAttachment($attachment3);

        $product->setQuantite($data['quantite']);
        


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
        ->findAllProduct();
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
     * @Route("/search/products/advance", methods={"POST"}, name="search_products_advance")
     */
    public function searchProductAdvance(Request $request){
        $data = json_decode($request->getContent(),true);
        $products = $this->getDoctrine()
        ->getRepository(Product::class)
        ->findAll();
        $productsMatch = array();
        $idMatch = array();
        $idRegex = array();
        $idProduct; 
        $cmp = 0;

        foreach ($products as $key => $product) {
            $arrayDescription = explode(' ', $product->getDescription() );
            foreach ($arrayDescription as $key => $word) {
                if( in_array($word, $data['input']['words'])   ){
                    $cmp ++;     
                }
            }
            if( $cmp == count($data['input']['words'])){
                $productsSearch[] = $this->getDoctrine()
                ->getRepository(Product::class)
                ->findProductById($product->getId());
            }

             $cmp = 0;
                    
            
        }
        
        $jsonContent = $this->serializer->serialize($productsSearch, 'json');
        return new Response($jsonContent);
    }

    /**
     * @Route("/get/products/{categories}", methods={"GET"}, name="get_products_categorie")
     */
    public function getProductsCategorie(String $categories){

        $entityManager = $this->getDoctrine()->getManager();
        $products = $this->getDoctrine()
        ->getRepository(Product::class)
        ->findAllProductByCat($categories);
        $jsonContent = $this->serializer->serialize($products, 'json');
        return new Response($jsonContent);
    }

    /**
     * @Route("get/img/{idProduct}", methods={"GET"}, name="get_img")
     */
     public function getImg(Int $idProduct){
        $entityManager = $this->getDoctrine()->getManager();
        $product = $this->getDoctrine()
        ->getRepository(Product::class)
        ->find($idProduct); 
        $arrayAttachments = array();
        foreach ($product->getAttachments() as $key => $img) {
            $arrayAttachments[] = $img->getFilename();
        }
        $jsonContent = $this->serializer->serialize( array(
            'img1'=>$arrayAttachments[0],
            'img2'=>$arrayAttachments[1],
            'img3'=>$arrayAttachments[2]
    
    ), 'json');
        return new Response($jsonContent);


     }
    
}
