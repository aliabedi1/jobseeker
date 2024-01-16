<?php

namespace App\Http\Controllers;


use GuzzleHttp\Client;

class HomeController extends Controller
{
    public function index()
    {
        $companyLinks = collect();
//        $browser = new Browser('chrome');
//

        $baseurl = 'https://jobinja.ir/jobs?&b=&filters%5Bjob_categories%5D%5B0%5D=&filters%5Bkeywords%5D%5B0%5D=laravel&filters%5Blocations%5D%5B0%5D=%D8%AA%D9%87%D8%B1%D8%A7%D9%86&page=';
        for ($pageNumber = 1; $pageNumber<9;$pageNumber++)
        {
            $client = new Client();
            $response = $client->request('GET', $baseurl.$pageNumber);
            $htmlContent = $response->getBody()->getContents();
            $elements = explode(
                ' <li class="o-listView__item o-listView__item--hasIndicator c-jobListView__item o-listView__item__application  ',
                $htmlContent
            );

            unset($elements[0]);
            unset($elements[sizeof($elements) - 1]);
            foreach ($elements as $element) {
                $companyLinkString = explode(
                    '<a class="o-listView__itemIndicator o-listView__itemIndicator--noPaddingBox" href="',
                    $element
                );

                $companyResponse = $client->request('GET', explode('?_ref=16', $companyLinkString[1])[0]);
                $companyHtmlContent = $companyResponse->getBody()->getContents();
                $companyElements = explode(
                    'companyHeader__metaItem',
                    $companyHtmlContent
                );
                $personnelCountString = explode('</s',str_replace('">','',$companyElements[3]))[0];
                dd($personnelCountString);


//                if ()
//                $companyLinks->add();
            }
        }
        dd($companyLinks);
    }
}
