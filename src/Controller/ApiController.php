<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\BalanceLog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("api/log", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function log(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $balanceLog = new BalanceLog();

        $date = \DateTime::createFromFormat('Y-m-d', $request->request->get('date'));

        $balanceLog
            ->setLoanBalance($request->request->get('loan_balance'))
            ->setOffsetBalance($request->request->get('offset_balance'))
            ->setDate($date);

        $entityManager->persist($balanceLog);
        $entityManager->flush();

        return new JsonResponse([
            'success' => true,
        ]);
    }
}
