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

    /**
     * @Route("/getall", name="outAll")
     */
    public function funcOutAll()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $myArray = [];

        $product = $this->getDoctrine()
            ->getRepository(Developer::class)
            ->findAllInFetch();

        if (!$product) {
            throw $this->createNotFoundException(
                'База данных пустая!'
            ); }


        $i = -1;
        $secondArray = [];
        while ($i <= count($product)) {
            ++$i;
            if ($product[$i]) {
                $secondArray[] = ($product[$i]->getId() . '<br>');
                $secondArray[] = ($product[$i]->getName() . '<br>');
                $secondArray[] = ($product[$i]->getPosition() . '<br>');
                $secondArray[] = ($product[$i]->getSkills() . '<br>');
                $myArray[] = $secondArray
                $secondArray ОЧИСТИТЬ
            }
        };
        // !!!Неясная ошибка "Object of class App\Entity\Developer could not be converted to string"!!!!!!!!!!!!!!!!!!!!!
        // !!!echo twig_escape_filter($this->env, $context["name"], "html", null, true);!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        // !!!Использовались разные способы и методы, требуется изучение возвращаемого объекта и синтаксиса массивов!!!!!

        // return $this->render('dev\send.html.twig', 'data'->$product);
        // return new Response($product);
        return $this->render('dev\send.html.twig', array('data'=>$product));
    }
};