<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Quest;
use App\Form\Field\TranslationField;
use App\Form\Field\VichImageField;
use App\Form\QuestObjectiveForm;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
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
        $published = BooleanField::new('published', t('Published', [], 'admin.quests'));
        $title = TextField::new('title', t('Title', [], 'admin.locations'));
        $locationImage = VichImageField::new('imageFile', t('Photo', [], 'admin.quests')->getMessage())
            ->setTemplatePath('admin/field/vich_image.html.twig')
            ->setCustomOption('base_path', $this->getParameter('app.quests.images.uri'))
            ->setFormTypeOption('required', false)
        ;
        $experience = NumberField::new('experience', t('Experience', [], 'admin.quests'));
        $minPlayerLevel = NumberField::new('minPlayerLevel', t('Min. player level', [], 'admin.quests'));
        $trader = AssociationField::new('trader', t('Trader', [], 'admin.quests'))
            ->setQueryBuilder(function($queryBuilder) {
                return $queryBuilder->join('entity.translations', 'lt', 'WITH', 'entity.id = lt.translatable')
                    ->addSelect('lt')
                    ->andWhere('lt.locale = :locale')
                    ->setParameter('locale', $this->container->get('request_stack')->getCurrentRequest()->getLocale())
                ;
            })
        ;
        $maps = AssociationField::new('map', t('Map', [], 'admin.quests'))
            ->setQueryBuilder(function($queryBuilder) {
                return $queryBuilder->join('entity.translations', 'lt', 'WITH', 'entity.id = lt.translatable')
                    ->addSelect('lt')
                    ->andWhere('lt.locale = :locale')
                    ->setParameter('locale', $this->container->get('request_stack')->getCurrentRequest()->getLocale())
                    ;
            })
        ;
        $slug = TextField::new('slug', t('Slug', [], 'admin.quests'))->setRequired(true);
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
        ];
        $translations = TranslationField::new('translations', t('Localization', [], 'admin.quests'), $translationFields)
            ->setFormTypeOptions([
                'excluded_fields' => ['lang', 'createdAt', 'updatedAt']
            ])
        ;
        $objectives = CollectionField::new('objectives', t('Objectives', [], 'admin.traders'))
            ->allowAdd()
            ->allowDelete()
            ->setEntryType(QuestObjectiveForm::class)
            ->setEntryIsComplex(false)
            ->setFormTypeOption('by_reference', false)
        ;

        $createdAt = DateField::new('createdAt', 'Created')->setTextAlign('center');
        $updatedAt = DateField::new('updatedAt', 'Updated')->setTextAlign('center');

        return match ($pageName) {
            Crud::PAGE_EDIT, Crud::PAGE_NEW => [
                FormField::addTab(t('Basic', [], 'admin.quests')),
                $locationImage,
                $published,
                $experience->setColumns(6),
                $minPlayerLevel->setColumns(6),
                $trader->setColumns(6),
                $maps->setColumns(6),
                $slug->setColumns(6),
                $translations,
                FormField::addTab(t('Objectives', [], 'admin.quests')),
                $objectives->setColumns(12),
                FormField::addTab(t('Keys', [], 'admin.quests')),
            ],
            default => [
                $title->setSortable(true),
                $published,
                $trader,
                $experience->setTextAlign('center'),
                $minPlayerLevel->setTextAlign('center'),
                $maps->setTextAlign('center'),
                $createdAt,
                $updatedAt],
        };
    }
}
