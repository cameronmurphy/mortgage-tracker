<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\BalanceLog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index(): Response
    {
        $logs = $this->getDoctrine()->getRepository(BalanceLog::class)->findAll();

        return $this->render('default/index.html.twig', ['logs' => $logs]);
    }
}
