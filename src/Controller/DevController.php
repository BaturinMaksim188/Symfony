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
        $product->setPosition('Миддл');
        $product->setSkills('Быстрота написания, чистый код');

        $entityManager->persist($product);
        $entityManager->flush();

        return new Response('Создана новая запись №'.$product->getId());
    }

    /**
     * @Route("/get/{id}", name="out")
     */
    public function funcOut(int $id): Response
    {
        $product = $this->getDoctrine()
            ->getRepository(Developer::class)
            ->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'Не найдено записи №'.$id
            );
        }

        return new Response('Поле имени из записи №'.$product->getId().":   Имя: ".$product->getName().", Позиция: ".$product->getPosition().", Навыки: ".$product->getSkills());
    }
}
