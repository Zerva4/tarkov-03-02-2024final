<?php

namespace App\Controller\Admin;

use App\Entity\Boss;
use App\Form\Field\TranslationField;
use App\Form\Field\VichImageField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
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
        $types = ChoiceField::new('types', t('Type', [], 'admin.enemies'))
            ->allowMultipleChoices()
            ->setTextAlign('left')
            ->setChoices([
                'TYPE_BOSS' => 'TYPE_BOSS',
                'TYPE_FOLLOWER' => 'ROLE_FOLLOWER',
            ])
            ->setTranslatableChoices([
                'TYPE_BOSS' => t('Boss', [], 'admin.enemies'),
                'TYPE_FOLLOWER' => t('Follower', [], 'admin.enemies'),
            ])
        ;
        $translationFields = [
            'name' => [
                'field_type' => TextType::class,
                'label' => t('Name', [], 'admin.enemies'),
            ],
            'behavior' => [
                'attr' => [
                    'class' => 'ckeditor'
                ],
                'field_type' => CKEditorType::class,
                'label' => t('Behavior', [], 'admin.enemies')
            ],
            'strategy' => [
                'attr' => [
                    'class' => 'ckeditor'
                ],
                'field_type' => CKEditorType::class,
                'label' => t('Strategy', [], 'admin.enemies')
            ],
            'followers' => [
                'attr' => [
                    'class' => 'ckeditor'
                ],
                'field_type' => CKEditorType::class,
                'label' => t('Followers', [], 'admin.enemies')
            ],
        ];
        $translations = TranslationField::new('translations', t('Localization', [], 'admin.enemies'), $translationFields)
            ->setFormTypeOptions([
                'excluded_fields' => ['lang', 'createdAt', 'updatedAt']
            ])
        ;

        return match ($pageName) {
            Crud::PAGE_EDIT, Crud::PAGE_NEW => [
                $image,
                $published,
                $types->setColumns(6)->setTextAlign('left'),
                $slug->setColumns(6)->setTextAlign('left'),
                $translations,
            ],
            default => [$name, $types, $published, $createdAt, $updatedAt],
        };
    }
}
