<?php

namespace App\Controller\Admin;

use App\Entity\Enemie;
use App\Form\Field\TranslationField;
use App\Form\Field\VichImageField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use function Symfony\Component\Translation\t;

class EnemieCrudController extends BaseCrudController
{
    public static function getEntityFqcn(): string
    {
        return Enemie::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $published = BooleanField::new('published', t('Published', [], 'admin.bosses'));
        $createdAt = DateField::new('createdAt', 'Created');
        $updatedAt = DateField::new('updatedAt', 'Updated');
        $name = TextField::new('name', t('Name', [], 'admin.bosses'));
        $slug = TextField::new('slug', t('Slug', [], 'admin.bosses'));
        $image = VichImageField::new('imageFile', t('Photo', [], 'admin.bosses')->getMessage())
            ->setTemplatePath('admin/field/vich_image.html.twig')
            ->setCustomOption('base_path', $this->getParameter('app.bosses.images.uri'))
            ->setFormTypeOption('required', false);
        ;
        $translationFields = [
            'name' => [
                'field_type' => TextType::class,
                'label' => t('Name', [], 'admin.bosses'),
            ],
            'behavior' => [
                'attr' => [
                    'class' => 'ckeditor'
                ],
                'field_type' => CKEditorType::class,
                'label' => t('Behavior', [], 'admin.bosses')
            ],
            'strategy' => [
                'attr' => [
                    'class' => 'ckeditor'
                ],
                'field_type' => CKEditorType::class,
                'label' => t('Strategy', [], 'admin.bosses')
            ],
            'followers' => [
                'attr' => [
                    'class' => 'ckeditor'
                ],
                'field_type' => CKEditorType::class,
                'label' => t('Followers', [], 'admin.bosses')
            ],
        ];
        $translations = TranslationField::new('translations', t('Localization', [], 'admin.bosses'), $translationFields)
            ->setFormTypeOptions([
                'excluded_fields' => ['lang', 'createdAt', 'updatedAt']
            ])
        ;

        return match ($pageName) {
            Crud::PAGE_EDIT, Crud::PAGE_NEW => [
                $image,
                $published,
                $slug,
                $translations,
            ],
            default => [$name, $published, $createdAt, $updatedAt],
        };
    }
}
