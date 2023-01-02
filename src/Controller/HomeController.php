<?php

namespace App\Controller;

use App\Entity\Member;
use App\Form\MemberType;
use App\Service\MemberService;
use App\Repository\MemberRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{
    // #[Route('/', name: 'app_home_index', methods: ['GET', 'POST'])]
    // public function new(Request $request, MemberRepository $memberRepository, MemberService $memberService): Response
    // {
    //     $members = $memberRepository->findBy([], ['name' => 'asc']);


    //     $member = new Member();
    //     $form = $this->createForm(MemberType::class, $member);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         // $memberRepository->save($member, true);
    //         return $memberService->handleMemberForm($form);

    //         //return $this->redirectToRoute('app_home_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->render('home/index.html.twig', [
    //         'members' => $members,
    //         'member' => $member,
    //         'form' => $form->createView()
    //     ]);
    // }

    #[Route('/', name: 'app_home_index')]
    public function index(RequestStack $requestStack, MemberService $memberService, MemberRepository $memberRepository): Response
    {
        $request = $requestStack->getMainRequest();

        $member = new Member();
        $form = $this->createForm(MemberType::class, $member);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            return $memberService->handleMemberForm($form);
        }

        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
            'members' => $memberRepository->findAll(),
            'member' => $member
        ]);
    }
}
