<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\BalanceLogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index(): Response
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/data.json", name="app_data_json")
     * @param BalanceLogRepository $repository
     * @return JsonResponse
     */
    public function dataJson(BalanceLogRepository $repository): JsonResponse
    {
        $logs = $repository
            ->createQueryBuilder('b')
            ->select([
                "to_char(b.date, 'YYYY-MM-DD') AS date",
                'b.loanBalance - b.offsetBalance AS remainingBalance'
            ])
            ->orderBy('b.date')
            ->getQuery()
            ->getResult();

        return new JsonResponse($logs);
    }
}
