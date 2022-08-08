<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Trader;
use App\Entity\TraderLoyalty;
use App\Form\Field\TranslationField;
use App\Form\TraderLoyaltyForm;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
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

    public function configureFields(string $pageName): iterable
    {
        $published = BooleanField::new('published', t('Published', [], 'admin.traders'));
        $fullName = TextField::new('fullName', t('Full name', [], 'admin.traders'));
        $characterType = TextField::new('characterType', t('Character type', [], 'admin.traders'));
        $slug = TextField::new('slug', t('Slug', [], 'admin.traders'));
        $avatar = ImageField::new('imageName', t('Photo', [], 'admin.traders'))
            ->setUploadDir($this->getParameter('app.traders.images.path'));
        $createdAt = DateField::new('createdAt', 'Created');
        $updatedAt = DateField::new('updatedAt', 'Updated');

        $translationFields = [
            'characterType' => [
                'field_type' => TextType::class,
                'label' => t('Character type', [], 'admin.traders')
            ],
            'fullName' => [
                'field_type' => TextType::class,
                'label' => t('Full name', [], 'admin.traders')
            ],
            'description' => [
                'attr' => [
                    'class' => 'ckeditor'
                ],
                'field_type' => CKEditorType::class,
                'label' => t('Description', [], 'admin.traders')
            ],
        ];
        $translations = TranslationField::new('translations', t('Localization', [], 'admin.locations'), $translationFields)
            ->setFormTypeOptions([
                'excluded_fields' => ['lang', 'createdAt', 'updatedAt']
            ])
        ;

        $loyalty = CollectionField::new('loyalty', t('Trader loyalty', [], 'admin.traders'))
            ->allowAdd()
            ->allowDelete()
            ->setEntryType(TraderLoyaltyForm::class)
            ->setEntryIsComplex(false)
            ->setFormTypeOption('by_reference', false)
        ;

        return match ($pageName) {
            Crud::PAGE_EDIT, Crud::PAGE_NEW => [
                FormField::addTab(t('Basic', [], 'admin.traders')),
                $published,
                $avatar->setColumns(6)->setTextAlign('left'),
                $slug->setColumns(6)->setTextAlign('left'),
                $translations,
                FormField::addTab(t('Additionally', [], 'admin.traders')),
                $loyalty->setColumns(12)
            ],
            default => [$characterType, $fullName, $published, $createdAt, $updatedAt],
        };
    }
}
