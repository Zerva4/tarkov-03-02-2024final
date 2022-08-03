<?php

namespace App\Controller\Admin;

use App\Entity\Location;
use App\Form\Field\TranslationsFormField;
use Doctrine\ORM\Query\FilterCollection;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use function Symfony\Component\Translation\t;

class LocationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Location::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $id = IntegerField::new('id', 'ID')->setColumns(0)->setTextAlign('left');
        $published = BooleanField::new('published', t('Published', [], 'admin.locations'));
        $title = TextField::new('title', t('Title', [], 'admin.locations'));
        $locationImage= ImageField::new('imageName', t('Photo', [], 'admin.locations'))
            ->setUploadDir($this->getParameter('app.locations.images.path'));
        $numberOfPlayers = TextField::new('numberOfPlayers', t('Number of players', [], 'admin.locations'));
        $raidDuration = NumberField::new('raidDuration', t('Raid duration', [], 'admin.locations'));
        $description  = TextEditorField::new('description', t('Description', [], 'admin.locations'));

        $translations = TranslationsFormField::new('translations', t('Localization', [], 'admin.locations'))
//            ->setFormType(TranslationsType::class)
            ->setTemplatePath('admin/fields/translation_form.html.twig')
            ->setFormTypeOptions([
                'translation_domain' => 'admin.locations',
                'default_locale' => 'ru',
                'fields' => [
                    'title' => ['field_type' => TextType::class],
                    'description' => ['field_type' => TextType::class],
                ],
                'excluded_fields' => ['lang']
            ])
        ;

        return match ($pageName) {
            Crud::PAGE_EDIT, Crud::PAGE_NEW => [
                $published,
                $locationImage->setColumns(6),
                $numberOfPlayers->setColumns(6),
                $raidDuration->setColumns(6),
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
