<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Trader\Trader;
use App\Form\Field\TranslationField;
use App\Form\Field\VichImageField;
use App\Form\TraderLevelForm;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use function Symfony\Component\Translation\t;

class TraderCrudController extends BaseCrudController
{
    public static function getEntityFqcn(): string
    {
        return Trader::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)->setSearchFields([
            'translations.shortName', 'translations.fullName'
        ]);
    }

    public function configureFields(string $pageName): iterable
    {
        $published = BooleanField::new('published', t('Published', [], 'admin.traders'));
        $fullName = TextField::new('fullName', t('Full name', [], 'admin.traders'));
        $shortName = TextField::new('shortName', t('Short name', [], 'admin.traders'));
        $slug = SlugField::new('slug', t('Slug', [], 'admin.traders'))
            ->setTargetFieldName('slug')
            ->setRequired(true);
        $avatar = VichImageField::new('imageFile', t('Photo', [], 'admin.locations')->getMessage())
            ->setTemplatePath('admin/field/vich_image.html.twig')
            ->setCustomOption('base_path', $this->getParameter('app.traders.images.uri'))
            ->setFormTypeOption('required', false)
        ;
        $createdAt = DateField::new('createdAt', 'Created');
        $updatedAt = DateField::new('updatedAt', 'Updated');
        $resetTime = DateTimeField::new('resetTime', 'Reset time')
            ->renderAsChoice()
            ->setFormat('yyyy.MM.dd G \'at\' HH:mm:ss zzz');

        $translationFields = [
            'shortName' => [
                'field_type' => TextType::class,
                'label' => t('Short name', [], 'admin.traders'),
            ],
            'fullName' => [
                'field_type' => TextType::class,
                'label' => t('Full name', [], 'admin.traders'),
            ],
            'description' => [
                'attr' => [
                    'class' => 'ckeditor'
                ],
                'field_type' => CKEditorType::class,
                'label' => t('Description', [], 'admin.traders')
            ],
        ];
        $translations = TranslationField::new('translations', t('Localization', [], 'admin'), $translationFields)
            ->setFormTypeOptions([
                'excluded_fields' => ['lang', 'createdAt', 'updatedAt']
            ])
        ;

        $levels = CollectionField::new('levels', t('Trader levels', [], 'admin.traders'))
            ->allowAdd()
            ->allowDelete()
            ->setEntryType(TraderLevelForm::class)
            ->setEntryIsComplex(false)
            ->setFormTypeOption('by_reference', false)
        ;

        return match ($pageName) {
            Crud::PAGE_EDIT, Crud::PAGE_NEW => [
                FormField::addTab(t('Basic', [], 'admin.traders')),
                $avatar,
                $published,
                $slug->setColumns(9)->setTextAlign('left'),
                $resetTime->setColumns(3),
                $translations,
                FormField::addTab(t('Levels', [], 'admin.traders')),
                $levels->setColumns(12)
            ],
            default => [
                $shortName->setTemplatePath('admin/field/link-edit.html.twig'),
                $fullName,
                $published, $createdAt, $updatedAt],
        };
    }
}
