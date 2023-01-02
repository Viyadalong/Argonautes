<?php

namespace App\Service;

use Twig\Environment;
use App\Entity\Member;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class MemberService
{
    public function __construct(
        private EntityManagerInterface $em,
        private Environment $environment
    )
    {
    }

    public function handleMemberForm(FormInterface $form) : JsonResponse
    {
        if ($form->isValid()) {
            return $this->handleValidForm($form);
        } else {
            return $this->handleInvalidForm($form);
        }
    }

    public function handleValidForm(FormInterface $form) : JsonResponse
    {
        /**@var object $member */
        $member = $form->getData();

        $this->em->persist($member);
        $this->em->flush();

        return new JsonResponse([
            'code' => Member::MEMBER_ADDED_SUCCESSFULLY,
            'html' => $this->environment->render('home/member.html.twig', [
                'member' => $member
            ])
        ]);
    }

    public function handleInvalidForm(FormInterface $form) : JsonResponse
    {
        return new JsonResponse([
            'code' => Member::MEMBER_INVALID_FORM
        ]);
    }
}