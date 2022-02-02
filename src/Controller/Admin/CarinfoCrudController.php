<?php

namespace App\Controller\Admin;

use App\Entity\Carinfo;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class CarinfoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Carinfo::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('Brand'),
            TextField::new('Model'),
            IntegerField::new('Year'),
            TextField::new('Vincode'),
            TextField::new('Numder'),
//            TextEditorField::new('description'),
            ImageField::new('image')
                ->setBasePath('images/car')
                ->setUploadDir('public/images/car')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
        ];
    }

}
