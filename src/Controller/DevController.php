<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Developer;
use Doctrine\ORM\EntityManagerInterface;


class DevController extends AbstractController
{
    /**
     * @Route("/111", name="save")
     */
    public function funcSave(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $product = new Developer();
        $product->setName('Keyboard');
        $product->setPosition('1999');
        $product->setSkills('Ergonomic and stylish!');

        // сообщите Doctrine, что вы хотите (в итоге) сохранить Продукт (пока без запросов)
        $entityManager->persist($product);

        // действительно выполните запросы (например, запрос INSERT)
        $entityManager->flush();

        return new Response('Saved new product with id '.$product->getId());
        return $this->render('dev/conduct.html.twig');
    }

    /**
     * @Route("/222", name="out")
     */
    public function funcOut(): Response
    {
        return $this->render('dev/send.html.twig');
    }
}
