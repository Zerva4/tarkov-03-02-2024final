<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Map;
use App\Form\Field\TranslationField;
use App\Form\Field\VichImageField;
use App\Form\MapLocationForm;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\BooleanFilter;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use function Symfony\Component\Translation\t;

class MapCrudController extends BaseCrudController
{
    public static function getEntityFqcn(): string
    {
        return Map::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)->setSearchFields([
            'id', 'translations.title',
        ]);
    }

    public function configureFields(string $pageName): iterable
    {
        $published = BooleanField::new('published', t('Published', [], 'admin.maps'));
        $title = TextField::new('title', t('Title', [], 'admin.maps'));
        $locationImage = VichImageField::new('imageFile', t('Photo', [], 'admin.maps')->getMessage())
            ->setTemplatePath('admin/field/vich_image.html.twig')
            ->setCustomOption('base_path', $this->getParameter('app.maps.images.uri'))
            ->setFormTypeOption('required', false);
        ;
        $minPlayersNumber = NumberField::new('minPlayersNumber', t('Min number of players', [], 'admin.maps'))->setRequired(true);
        $maxPlayersNumber = NumberField::new('maxPlayersNumber', t('Max number of players', [], 'admin.maps'))->setRequired(true);
        $raidDuration = TimeField::new('raidDuration', t('Raid duration', [], 'admin.maps'))
            ->setRequired(true)
            ->setFormat('HH:mm')
        ;
        $slug = TextField::new('slug', t('Slug', [], 'admin.maps'))->setRequired(true);
        $translationFields = [
            'title' => [
                'field_type' => TextType::class,
                'label' => t('Title', [], 'admin.maps')
            ],
            'description' => [
                'attr' => [
                    'class' => 'ckeditor'
                ],
                'field_type' => CKEditorType::class,
                'label' => t('Description', [], 'admin.maps')
            ],
        ];
        $translations = TranslationField::new('translations', t('Localization', [], 'admin.maps'), $translationFields)
            ->setFormTypeOptions([
                'excluded_fields' => ['lang', 'createdAt', 'updatedAt']
            ])
        ;
        $locations = CollectionField::new('locations')
            ->allowAdd()
            ->allowDelete()
            ->showEntryLabel(false)
            ->setEntryType(MapLocationForm::class)
            ->setEntryIsComplex(false)
            ->setFormTypeOption('by_reference', false)
        ;

        return match ($pageName) {
            Crud::PAGE_EDIT, Crud::PAGE_NEW => [
                FormField::addTab(t('Basic', [], 'admin.maps')),
                $locationImage->setColumns(4),
                $published,
                $minPlayersNumber->setColumns(3),
                $maxPlayersNumber->setColumns(3),
                $raidDuration->setColumns(3),
                $slug->setColumns(3),
                $translations,
                FormField::addTab(t('Locations', [], 'admin.maps')),
                $locations->setColumns(12)
            ],
            default => [
                $title->setColumns(12)->setTextAlign('left'),
                $published->setColumns(1)->setTextAlign('center'),
                $minPlayersNumber->setColumns(2)->setTextAlign('center'),
                $maxPlayersNumber->setColumns(2)->setTextAlign('center'),
                $raidDuration->setColumns(2)->setTextAlign('center'),
                DateField::new('createdAt', t('Created', [], 'admin'))->setTextAlign('center'),
                DateField::new('updatedAt', t('Updated', [], 'admin'))->setTextAlign('center'),
            ]
        };
    }
}
