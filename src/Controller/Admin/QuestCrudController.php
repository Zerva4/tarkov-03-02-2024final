<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Quest;
use App\Form\Field\TranslationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use function Symfony\Component\Translation\t;

class QuestCrudController extends BaseCrudController
{
    public static function getEntityFqcn(): string
    {
        return Quest::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $published = BooleanField::new('published', t('Published', [], 'admin.locations'));
        $title = TextField::new('title', t('Title', [], 'admin.locations'));
        $locationImage= ImageField::new('imageName', t('Photo', [], 'admin.locations'))
            ->setUploadDir($this->getParameter('app.quests.images.path'));
        $trader = AssociationField::new('trader', t('Trader', [], 'admin.quests'))
            ->setQueryBuilder(function($queryBuilder) {
                return $queryBuilder->join('entity.translations', 'lt', 'WITH', 'entity.id = lt.translatable')
                    ->addSelect('lt')
                    ->andWhere('lt.locale = :locale')
                    ->setParameter('locale', $this->container->get('request_stack')->getCurrentRequest()->getLocale())
                ;
            })
        ;
        $location = AssociationField::new('location', t('Location', [], 'admin.quests'));
        $translationFields = [
            'title' => [
                'field_type' => TextType::class,
                'label' => t('Title', [], 'admin.quests')
            ],
            'description' => [
                'attr' => [
                    'class' => 'ckeditor'
                ],
                'field_type' => CKEditorType::class,
                'label' => t('Description', [], 'admin.quests')
            ],
            'howToComplete' => [
                'attr' => [
                    'class' => 'ckeditor'
                ],
                'field_type' => CKEditorType::class,
                'label' => t('How to complete', [], 'admin.quests')
            ],
            'goals' => [
                'attr' => [
                    'class' => 'ckeditor'
                ],
                'field_type' => CKEditorType::class,
                'label' => t('Goals', [], 'admin.quests')
            ],
        ];
        $translations = TranslationField::new('translations', t('Localization', [], 'admin.locations'), $translationFields)
            ->setFormTypeOptions([
                'excluded_fields' => ['lang', 'createdAt', 'updatedAt']
            ])
        ;

        $createdAt = DateField::new('createdAt', 'Created');
        $updatedAt = DateField::new('updatedAt', 'Updated');

        return match ($pageName) {
            Crud::PAGE_EDIT, Crud::PAGE_NEW => [
                $published,
                $locationImage->setColumns(6),
                $trader->setColumns(6),
                $location->setColumns(6),
                $translations
            ],
            default => [$title, $trader, $location, $published, $createdAt, $updatedAt],
        };
    }
}
