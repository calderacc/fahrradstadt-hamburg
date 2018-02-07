<?php

namespace UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
use UserBundle\Form\Type\UserEmailType;
use UserBundle\Form\Type\UsernameType;

class ProfileManagementController extends Controller
{
    /**
     * @Security("has_role('ROLE_USER')")
     */
    public function indexAction(Request $request, UserInterface $user): Response
    {
        return $this->render('UserBundle:ProfileManagement:index.html.twig');
    }

    /**
     * @Security("has_role('ROLE_USER')")
     */
    public function editUsernameAction(Request $request, UserInterface $user): Response
    {
        $usernameForm = $this->createForm(
            UsernameType::class,
            $user,
            [
                'action' => $this->generateUrl(
                    'profile_management_username'
                )
            ]
        );

        if ($request->isMethod(Request::METHOD_POST)) {
            $usernameForm->handleRequest($request);

            if ($usernameForm->isSubmitted() && $usernameForm->isValid()) {
                /** @var $userManager UserManagerInterface */
                $userManager = $this->get('fos_user.user_manager');

                try {
                    $userManager->updateUser($user);

                    $this->addFlash('success', 'Deine neuer Benutzername wurde gespeichert. Du heißt jetzt ' . $user->getUsername() . '!');

                    return $this->redirectToRoute('criticalmass_user_usermanagement');
                } catch (UniqueConstraintViolationException $exception) {
                    $error = new FormError('Dieser Benutzername ist bereits vergeben.');

                    $usernameForm->get('username')->addError($error);
                }
            }
        }

        return $this->render(
            'UserBundle:ProfileManagement:edit_username.html.twig',
            [
                'usernameForm' => $usernameForm->createView()
            ]
        );
    }

    /**
     * @Security("has_role('ROLE_USER')")
     */
    public function editEmailAction(Request $request, UserInterface $user): Response
    {
        $userEmailForm = $this->createForm(
            UserEmailType::class,
            $user,
            [
                'action' => $this->generateUrl(
                    'profile_management_index'
                )
            ]
        );

        if ($request->isMethod(Request::METHOD_POST)) {
            $userEmailForm->handleRequest($request);

            if ($userEmailForm->isSubmitted() && $userEmailForm->isValid()) {
                /** @var $userManager UserManagerInterface */
                $userManager = $this->get('fos_user.user_manager');

                try {
                    $userManager->updateUser($user);

                    $this->addFlash('success', 'Deine neue E-Mail-Adresse wurde gespeichert. Du kannst dich ab jetzt mit ' . $user->getEmail() . ' einloggen.');

                    return $this->redirectToRoute('profile_management_index');
                } catch (UniqueConstraintViolationException $exception) {
                    $error = new FormError('Diese E-Mail-Adresse ist bereits registriert worden.');

                    $userEmailForm->get('email')->addError($error);
                }
            }
        }

        return $this->render(
            'UserBundle:ProfileManagement:edit_email.html.twig',
            [
                'userEmailForm' => $userEmailForm->createView()
            ]
        );
    }
}