<?php

namespace App\Controller\Admin;

//use App\Entity\User;
//use App\Entity\Product;
//use App\Entity\ProductDetail;
use App\Entity\Person;
use App\Entity\Job;
use App\Entity\Work;
use App\Entity\Carinfo;
use App\Entity\Order;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('bandles/easyAdminBandles/welcome.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Admin Panel');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Person', 'fas fa-user', Person::class);
        yield MenuItem::linkToCrud('Job', 'fas fa-screwdriver', Job::class);
        yield MenuItem::linkToCrud('Work', 'fas fa-wrench', Work::class);
        yield MenuItem::linkToCrud('Carinfo', 'fas fa-car-alt', Carinfo::class);
        yield MenuItem::linkToCrud('Order', 'fas fa-money-check-alt', Order::class);
    }
}
