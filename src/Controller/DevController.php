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
     * @Route("/add", name="save")
     */
    public function funcSave(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $product = new Developer();
        $product->setName('Максим');
        $product->setPosition('Джуниор');
        $product->setSkills('Чистый код');

        $entityManager->persist($product);
        $entityManager->flush();

        return new Response('Создана новая запись №'.$product->getId());
    }

    /**
     * @Route("/get", name="out")
     */
    public function funcOut(): Response
    {
        return $this->render('dev/send.html.twig');
    }
}
