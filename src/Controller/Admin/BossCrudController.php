<?php

namespace App\Controller\Admin;

use App\Entity\Boss;
use App\Form\BossHealthForm;
use App\Form\Field\TranslationField;
use App\Form\Field\VichImageField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CodeEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use function Symfony\Component\Translation\t;

class BossCrudController extends BaseCrudController
{
    public static function getEntityFqcn(): string
    {
        return Boss::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)->setSearchFields([
            'translations.title',
        ]);
    }

    public function configureFields(string $pageName): iterable
    {
        $published = BooleanField::new('published', t('Published', [], 'admin.enemies'));
        $createdAt = DateField::new('createdAt', 'Created');
        $updatedAt = DateField::new('updatedAt', 'Updated');
        $name = TextField::new('name', t('Name', [], 'admin.enemies'));
        $slug = SlugField::new('slug', t('Slug', [], 'admin.enemies'))
            ->setTargetFieldName('slug')
            ->setRequired(true);
        $image = VichImageField::new('imageFile', t('Photo', [], 'admin.enemies')->getMessage())
            ->setTemplatePath('admin/field/vich_image.html.twig')
            ->setCustomOption('base_path', $this->getParameter('app.enemies.images.uri'))
            ->setFormTypeOption('required', false);
        ;
        $translationFields = [
            'name' => [
                'field_type' => TextType::class,
                'label' => t('Name', [], 'admin.enemies'),
            ],
        ];
        $translations = TranslationField::new('translations', t('Localization', [], 'admin.enemies'), $translationFields)
            ->setFormTypeOptions([
                'excluded_fields' => ['lang', 'createdAt', 'updatedAt']
            ])
        ;

        $health = CollectionField::new('health')
            ->setEntryType(BossHealthForm::class)
            ->allowAdd()
            ->allowDelete()
            ->showEntryLabel(true)
            ->setEntryIsComplex(true)
            ->setFormTypeOption('by_reference', false)
        ;

        return match ($pageName) {
            Crud::PAGE_EDIT, Crud::PAGE_NEW => [
                FormField::addTab(t('Basic', [], 'admin.enemies')),
                $image,
                $published,
                $slug->setColumns(12),
                $translations,
                FormField::addTab(t('Health', [], 'admin.enemies')),
                $health->setColumns(12),
                FormField::addTab(t('Equipment', [], 'admin.enemies')),
            ],
            default => [
                $name->setTextAlign('left')->setTemplatePath('admin/field/link-edit.html.twig'),
                $published,
                $createdAt,
                $updatedAt
            ],
        };
    }
}
