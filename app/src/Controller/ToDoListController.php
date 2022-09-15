<?php

namespace App\Controller;

use App\Entity\Task;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ToDoListController extends AbstractController
{
    /**
     * @Route("/to/do/list" ,name="app_to_do_list")
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $tasks = $entityManager->getRepository(Task::class)->findBy([],['id'=>'DESC']);
        return $this->render('index.html.twig', ['tasks'=> $tasks]);
    }

    /**
     * @Route("/create", name="create_task" , methods={"POST"})
     */
    public function create(Request $request,  EntityManagerInterface $entityManager): RedirectResponse
    {
        $title = trim($request->get('title'));
        if(empty($title)) {
            return $this->redirectToRoute('app_to_do_list');
        }

        $task = new Task();
        $task->setTitle($title);
        $task->setStatus(false);
        $entityManager->persist($task);
        $entityManager->flush();

        return $this->redirectToRoute('app_to_do_list');

    }

    /**
     * @Route("/switch-status/{id}", name="switch_status")
     */
    public function switchStatus($id,  EntityManagerInterface $entityManager)
    {
        $task = $entityManager->getRepository(Task::class)->find($id);
        if( $task instanceof Task) {
            $task->setStatus(!$task->isStatus());
            $entityManager->flush();
        }


        return $this->redirectToRoute('app_to_do_list');
    }


    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete($id, EntityManagerInterface $entityManager)
    {
        $task = $entityManager->getRepository(Task::class)->find($id);
        if($task instanceof Task) {
            $entityManager->remove($task);
            $entityManager->flush();
        }
        return $this->redirectToRoute('app_to_do_list');
    }
}

