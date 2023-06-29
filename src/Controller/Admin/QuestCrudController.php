<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Quest\Quest;
use App\Form\ContainedItemForm;
use App\Form\Field\TranslationField;
use App\Form\Field\VichImageField;
use App\Form\QuestKeyFormType;
use App\Form\QuestObjectiveForm;
use App\Repository\Item\ContainedItemRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\BooleanFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\NumericFilter;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use function Symfony\Component\Translation\t;

class QuestCrudController extends BaseCrudController
{
    public static function getEntityFqcn(): string
    {
        return Quest::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)->setSearchFields([
            'translations.title',
        ]);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(BooleanFilter::new('published', t('Published', [], 'admin.quests')))
            ->add(NumericFilter::new('experience', t('Experience', [], 'admin.quests')))
            ->add(NumericFilter::new('minPlayerLevel', t('Min. player level', [], 'admin.quests')))
            ->add(EntityFilter::new('trader', t('Trader', [], 'admin.quests')))
            ->add(EntityFilter::new('map', t('Map', [], 'admin.quests')))
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        $published = BooleanField::new('published', t('Published', [], 'admin.quests'));
        $restartable = BooleanField::new('restartable', t('Restartable', [], 'admin.quests'));
        $kappaRequired = BooleanField::new('kappaRequired', t('Kappa required', [], 'admin.quests'));
        $lightkeeperRequired = BooleanField::new('lightkeeperRequired', t('Lightkeeper required', [], 'admin.quests'));
        $title = TextField::new('title', t('Title', [], 'admin.quests'));
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
            'startDialog' => [
                'attr' => [
                    'class' => 'ckeditor'
                ],
                'field_type' => CKEditorType::class,
                'label' => t('Start dialog', [], 'admin.quests')
            ],
            'successfulDialog' => [
                'attr' => [
                    'class' => 'ckeditor'
                ],
                'field_type' => CKEditorType::class,
                'label' => t('Successful dialog', [], 'admin.quests')
            ]
        ];
        $translations = TranslationField::new('translations', t('Localization', [], 'admin.quests'), $translationFields)
            ->setFormTypeOptions([
                'excluded_fields' => ['lang', 'createdAt', 'updatedAt']
            ])
        ;
        $slug = SlugField::new('slug', t('Slug', [], 'admin.quests'))
            ->setTargetFieldName('slug')
            ->setRequired(true);
        $objectives = CollectionField::new('objectives', t('Objectives', [], 'admin.quests'))
            ->allowAdd()
            ->allowDelete()
            ->setEntryType(QuestObjectiveForm::class)
            ->setEntryIsComplex(false)
            ->setFormTypeOption('by_reference', false)
        ;
        $keys = CollectionField::new('neededKeys', t('Keys', [], 'admin.quests'))
            ->allowAdd()
            ->allowDelete()
            ->setEntryType(QuestKeyFormType::class)
            ->setEntryIsComplex(false)
            ->setFormTypeOption('by_reference', false)
        ;
        $usedItems = CollectionField::new('usedItems', t('Required items', [], 'admin.barters'))
            ->allowAdd()
            ->allowDelete()
            ->setEntryType(ContainedItemForm::class)
            ->setEntryIsComplex(false)
            ->setFormTypeOption('by_reference', true)
        ;
        $receivedItems = CollectionField::new('receivedItems', t('Reward items', [], 'admin.barters'))
            ->allowAdd()
            ->allowDelete()
            ->setEntryType(ContainedItemForm::class)
            ->setEntryIsComplex(false)
            ->setFormTypeOption('by_reference', true)
        ;

        $createdAt = DateField::new('createdAt', 'Created')->setTextAlign('center');
        $updatedAt = DateField::new('updatedAt', 'Updated')->setTextAlign('center');

//        $ciRepo = $this->get(ContainedItemRepository::class);
//        $ciRepo->Test('f89277e7-ba90-4b52-a48d-d5c87cb7e475', '5a7c147ce899ef00150bd8b8');

        return match ($pageName) {
            Crud::PAGE_EDIT, Crud::PAGE_NEW => [
                FormField::addTab(t('Basic', [], 'admin.quests')),
                $locationImage,
                $published->setColumns(3),
                $restartable->setColumns(3),
                $kappaRequired->setColumns(3),
                $lightkeeperRequired->setColumns(3),
                $experience->setColumns(6),
                $minPlayerLevel->setColumns(6),
                $trader->setColumns(6),
                $maps->setColumns(6),
                $slug->setColumns(6),
                $translations,
                FormField::addTab(t('Objectives', [], 'admin.quests')),
                $objectives->setColumns(12),
                FormField::addTab(t('Items', [], 'admin.quests')),
                $usedItems->setColumns(6),
                $receivedItems->setColumns(6),
                FormField::addTab(t('Keys', [], 'admin.quests')),
                $keys->setColumns(12),
            ],
            default => [
                $title->setSortable(true)->setTemplatePath('admin/field/link-edit.html.twig'),
                $published,
                $restartable,
                $trader,
                $experience->setTextAlign('center'),
                $minPlayerLevel->setTextAlign('center'),
                $maps->setTextAlign('center'),
                $createdAt,
                $updatedAt
            ],
        };
    }
}
