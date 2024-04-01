<?php

namespace App\Controller;

use App\Repository\TarifRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilder;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(TarifRepository $tarifRepo, ChartBuilderInterface $chartJs): Response
    {
        $getTop10PlusChers = $tarifRepo->getTop10PlusChers();
        $chart = $chartJs->createChart(Chart::TYPE_LINE);
        $prixs = [];
        $labels = [];
        foreach($getTop10PlusChers as $tarif){
            $prixs[]=$tarif->getPrix();
            $labels[]=substr($tarif->getBar()->getNom() . ' ' . $tarif->getBiere()->getNom(),0,10);
        }

        $chart->setData([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Top 10 bières les plus chers',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => $prixs,
                ],
            ],
        ]);

        $chart->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 20,
                ],
            ],
        ]);

        return $this->render('home/index.html.twig', [
            'chart' => $chart,
        ]);
    }
}
