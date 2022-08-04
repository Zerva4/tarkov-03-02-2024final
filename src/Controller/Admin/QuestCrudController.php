<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Quest;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use function Symfony\Component\Translation\t;

class QuestCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Quest::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $title = TextField::new('title', t('Title'));
        $description = TextEditorField::new('description', t('Description text'));
        $howToComplete = TextEditorField::new('howToComplete', t('How to complete text'));

        return match ($pageName) {
            Crud::PAGE_EDIT, Crud::PAGE_NEW => [
                $title, $description, $howToComplete
            ],
            default => [$title],
        };
    }
}
