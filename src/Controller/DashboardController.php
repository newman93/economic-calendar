<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\ApiService;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Request;


class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="app_dashboard")
     */
    public function index(Request $request,  HttpClientInterface $client): Response
    {
        $api = new ApiService($client);
        $data =  $api->getData(date('Y-m-d'), date('Y-m-d'));

        $apiData = JSON_DECODE($data[0], TRUE);
        $info = $data[1]  == 402 ? 'The number of queries to the api has been exceeded!' : '';   

        return $this->render('dashboard/index.html.twig', [
            'data' => $apiData,
            'info' => $info
        ]);
    }

    
    /**
     * @Route("/dataset", name="app_dashboard_from_to")
     */
    public function dataset(Request $request,  HttpClientInterface $client): Response
    {
        $api = new ApiService($client);
        $data =  $api->getData($request->get('from'), $request->get('to'));

        $apiData = JSON_DECODE($data[0], TRUE);
        $info = $data[1]  == 402 ? 'The number of queries to the api has been exceeded!' : '';   

        return $this->render('dashboard/index.html.twig', [
            'data' => $apiData,
            'info' => $info
        ]);
    }
}
