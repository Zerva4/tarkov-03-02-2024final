<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use function Symfony\Component\Translation\t;
use Doctrine\ORM\EntityManagerInterface;

class UserCrudController extends AbstractCrudController
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->passwordHasher = $encoder;
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $login = TextField::new('login', t('Login'))
            ->setColumns(4)
            ->setTextAlign('left')
            ->setFormTypeOption('attr', ['autocomplete' => 'new-password'])
        ;
        $email = EmailField::new('email', t('E-mail'))
            ->setColumns(4)
            ->setTextAlign('left')
            ->setFormTypeOption('attr', ['autocomplete' => 'new-password'])
        ;
        $title = TextField::new('title', t('Title'))->setColumns(4)->setTextAlign('left');
        $roles = ChoiceField::new('roles', t('Role'))
            ->allowMultipleChoices()
            ->setTextAlign('left')
            ->setChoices([
                'ROLE_ADMIN' => 'ROLE_ADMIN',
                'ROLE_EDITOR' => 'ROLE_EDITOR',
                'ROLE_USER' => 'ROLE_USER',
            ])
            ->setTranslatableChoices([
                'ROLE_ADMIN' => t('Administrator'),
                'ROLE_EDITOR' => t('Editor'),
                'ROLE_USER' => t('User'),
            ])
        ;
        $newPassword = TextField::new('newPassword')->setFormType(PasswordType::class)
            ->setFormType(PasswordType::class)
            ->setDisabled(false)
            ->setFormTypeOption('empty_data', '')
            ->setFormTypeOption('attr', ['autocomplete' => 'new-password'])
            ->setRequired(false)
            ->setLabel(t('Password'))
            ->setFormTypeOption('mapped', false)
        ;
        $confirmPassword = TextField::new('confirmPassword')
            ->setFormType(PasswordType::class)
            ->setDisabled(false)
            ->setFormTypeOption('empty_data', '')
            ->setFormTypeOption('attr', ['autocomplete' => 'new-password'])
            ->setRequired(false)
            ->setLabel(t('Confirm password'))
        ;
        $createdAt = DateField::new('createdAt', 'Created');
        $updatedAt = DateField::new('updatedAt', 'Updated');

        return match ($pageName) {
            Crud::PAGE_EDIT => [
                FormField::addPanel('Main'),
                $login->setColumns(6),
                $email->setColumns(6),
                $title->setColumns(6),
                $roles->setColumns(6),
                FormField::addPanel('Change password'),
                $newPassword->setColumns(6)->setDisabled(false)->setLabel(t('New password')),
                $confirmPassword->setColumns(6)->setDisabled(false)->setLabel(t('Confirm new password')),
            ],
            Crud::PAGE_NEW => [
                FormField::addPanel('Main'),
                $login->setColumns(6),
                $email->setColumns(6),
                $title->setColumns(6),
                $roles->setColumns(6),
                FormField::addPanel('Password'),
                $newPassword->setColumns(6)->setVirtual(true),
                $confirmPassword->setColumns(6)->setVirtual(true),
            ],
            default => [
                $login->setTemplatePath('admin/field/link-edit.html.twig'),
                $email, $title, $roles, $createdAt, $updatedAt],
        };
    }

    #[NoReturn]
    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $clearPassword = trim($this->getCurrentRequest()->request->all()['User']['clearpassword']);
    }

    /**
     * @return UserPasswordHasherInterface
     */
    public function getPasswordHasher(): UserPasswordHasherInterface
    {
        return $this->passwordHasher;
    }

    #[NoReturn] public function createEntity(string $entityFqcn)
    {
        $entity = parent::createEntity($entityFqcn);

        die();
    }
}
