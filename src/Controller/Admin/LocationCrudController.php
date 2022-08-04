<?php

namespace App\Controller\Admin;

use App\Entity\Location;
use App\Form\Field\TranslationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use function Symfony\Component\Translation\t;

class LocationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Location::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setFormThemes([
                'admin/field/translation.html.twig',
                '@EasyAdmin/crud/form_theme.html.twig',
                '@FOSCKEditor/Form/ckeditor_widget.html.twig',
            ])
        ;
    }

//    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
//    {
//        $qb = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);
//        $searchQuery = $searchDto->getQuery();
//
//        if ($searchQuery) {
//            $qb
//                ->leftJoin(UserTranslation::class, 'ut', 'WITH', 'ut.translatable = entity.id')
//                ->orWhere(
//                    'LOWER(ut.firstname) LIKE LOWER(:search) OR LOWER(ut.middlename) LIKE LOWER(:search) OR LOWER(ut.lastname) LIKE LOWER(:search) OR entity.id LIKE :search'
//                )
//                ->setParameter('search', "%$searchQuery%");
//        }
//
//        return $qb;
//    }

    public function configureFields(string $pageName): iterable
    {
        $id = IntegerField::new('id', 'ID')->setColumns(0)->setTextAlign('left');
        $published = BooleanField::new('published', t('Published', [], 'admin.locations'));
        $title = TextField::new('title', t('Title', [], 'admin.locations'));
        $locationImage= ImageField::new('imageName', t('Photo', [], 'admin.locations'))
            ->setUploadDir($this->getParameter('app.locations.images.path'));
        $numberOfPlayers = TextField::new('numberOfPlayers', t('Number of players', [], 'admin.locations'));
        $raidDuration = NumberField::new('raidDuration', t('Raid duration', [], 'admin.locations'));
        $translations = TranslationField::new('translations', t('Localization', [], 'admin.locations'),
            [
                'title' => ['field_type' => TextType::class],
                'description' => [
                    'attr' => [
                        'class' => 'ckeditor'
                    ],
                    'field_type' => CKEditorType::class
                ],
            ]
        )
            ->setFormTypeOptions([
                'excluded_fields' => ['lang']
            ])
        ;

        return match ($pageName) {
            Crud::PAGE_EDIT, Crud::PAGE_NEW => [
                $published,
                $locationImage->setColumns(4),
                $numberOfPlayers->setColumns(4),
                $raidDuration->setColumns(4),
                $translations,
            ],
            default => [
                $id->setColumns(1)->setTextAlign('left'),
                $title,
                $published->setColumns(1)->setTextAlign('left'),
                $numberOfPlayers->setColumns(2)->setTextAlign('left'),
                $raidDuration->setColumns(2)->setTextAlign('left')
            ]
        };
    }
}
