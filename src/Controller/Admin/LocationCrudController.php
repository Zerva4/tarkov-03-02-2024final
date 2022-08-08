<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Location;
use App\Form\Field\TranslationField;
use App\Form\Field\VichImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use function Symfony\Component\Translation\t;

class LocationCrudController extends BaseCrudController
{
    public static function getEntityFqcn(): string
    {
        return Location::class;
    }

//    public function configureCrud(Crud $crud): Crud
//    {
//        return parent::configureCrud($crud)
//            ->setFormThemes([
//                'admin/field/translation.html.twig',
//                'admin/field/vich_image.html.twig',
//                '@EasyAdmin/crud/form_theme.html.twig',
//                '@FOSCKEditor/Form/ckeditor_widget.html.twig',
//            ])
//        ;
//    }

    public function configureFields(string $pageName): iterable
    {
        $published = BooleanField::new('published', t('Published', [], 'admin.locations'));
        $title = TextField::new('title', t('Title', [], 'admin.locations'));
        $locationImage = VichImageField::new('imageFile', t('Photo', [], 'admin.locations')->getMessage())
            ->setTemplatePath('admin/field/vich_image.html.twig')
            ->setCustomOption('base_path', $this->getParameter('app.locations.images.uri'))
            ->setFormTypeOption('required', false);
        ;
        $numberOfPlayers = TextField::new('numberOfPlayers', t('Number of players', [], 'admin.locations'))->setRequired(true);
        $raidDuration = TimeField::new('raidDuration', t('Raid duration', [], 'admin.locations'))->setRequired(true);
        $slug = TextField::new('slug', t('Slug', [], 'admin.locations'))->setRequired(true);
        $translationFields = [
            'title' => [
                'field_type' => TextType::class,
                'label' => t('Title', [], 'admin.locations')
            ],
            'description' => [
                'attr' => [
                    'class' => 'ckeditor'
                ],
                'field_type' => CKEditorType::class,
                'label' => t('Description', [], 'admin.locations')
            ],
        ];
        $translations = TranslationField::new('translations', t('Localization', [], 'admin.locations'), $translationFields)
            ->setFormTypeOptions([
                'excluded_fields' => ['lang', 'createdAt', 'updatedAt']
            ])
        ;

        return match ($pageName) {
            Crud::PAGE_EDIT, Crud::PAGE_NEW => [
                $locationImage->setColumns(4),
                $published,
                $numberOfPlayers->setColumns(4),
                $raidDuration->setColumns(4),
                $slug->setColumns(4),
                $translations,
            ],
            default => [
                $title->setColumns(12)->setTextAlign('left'),
                $published->setColumns(1)->setTextAlign('center'),
                $numberOfPlayers->setColumns(2)->setTextAlign('center'),
                $raidDuration->setColumns(2)->setTextAlign('center'),
                DateField::new('createdAt', t('Created', [], 'admin'))->setTextAlign('center'),
                DateField::new('updatedAt', t('Updated', [], 'admin'))->setTextAlign('center'),
            ]
        };
    }
}
