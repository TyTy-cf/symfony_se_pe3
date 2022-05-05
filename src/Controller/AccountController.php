<?php

namespace App\Controller;

use App\Repository\AccountRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/compte')]
class AccountController extends AbstractController
{

    public function __construct(
        private AccountRepository $accountRepository
    )
    {
    }

    #[Route('/', name: 'app_account')]
    public function index(): Response
    {
        return $this->render('account/index.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }

    #[Route('/{slug}', name: 'app_account_show')]
    public function show(string $slug): Response
    {
        $account = $this->accountRepository->findOneBy(['slug' => $slug]);
        return $this->render('account/show.html.twig', [
            'account' => $account,
        ]);
    }
}
