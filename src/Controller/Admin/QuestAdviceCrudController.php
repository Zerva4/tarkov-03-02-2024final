<?php

namespace App\Controller\Admin;

use App\Entity\Quest\QuestAdvice;
use App\Form\Field\TranslationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use function Symfony\Component\Translation\t;

class QuestAdviceCrudController extends BaseCrudController
{
    public static function getEntityFqcn(): string
    {
        return QuestAdvice::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)->setSearchFields([
            'translations.body',
        ]);
    }

    public function configureFields(string $pageName): iterable
    {
        $createdAt = DateField::new('createdAt', t('Created', [], 'admin'));
        $updatedAt = DateField::new('updatedAt', t('Updated', [], 'admin'));
        $published = BooleanField::new('published', t('Published', [], 'admin'));
        $body = TextField::new('body', t('Advice', [], 'admin.quests_advice'));
        $quests = AssociationField::new('quests', t('Quests', [], 'admin.quests_advice'));
        $translationFields = [
            'body' => [
                'field_type' => CKEditorType::class,
                'label' => t('Name', [], 'admin.quests_advice')
            ],
        ];
        $translations = TranslationField::new('translations', t('Localization', [], 'admin'), $translationFields)
            ->setFormTypeOptions([
                'excluded_fields' => ['lang', 'createdAt', 'updatedAt']
            ])
        ;

        return match ($pageName) {
            Crud::PAGE_EDIT, Crud::PAGE_NEW => [
                $published,
                $quests->setColumns(12),
                $translations->setColumns(12),
            ],
            default => [
                $published,
                $body->setColumns(12)->setTemplatePath('admin/field/advice-body.html.twig'),
                $createdAt->setColumns(1)->setTextAlign('center'),
                $updatedAt->setColumns(1)->setTextAlign('center'),
            ]
        };
    }

}
