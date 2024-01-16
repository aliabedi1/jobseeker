<?php

namespace App\Http\Controllers;


use App\Models\Link;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    public function index()
    {
        set_time_limit(1000000);
        $jobAdLinks = collect();

        $baseurl = 'https://jobinja.ir/jobs?&b=&filters%5Bjob_categories%5D%5B0%5D=&filters%5Bkeywords%5D%5B0%5D=laravel&filters%5Blocations%5D%5B0%5D=%D8%AA%D9%87%D8%B1%D8%A7%D9%86&page=';
        for ($pageNumber = 1; $pageNumber < 9; $pageNumber++) {
            $client = new Client();
            $response = $client->request('GET', $baseurl . $pageNumber);
            $htmlContent = $response->getBody()->getContents();
            $elements = explode(
                ' <li class="o-listView__item o-listView__item--hasIndicator c-jobListView__item o-listView__item__application  ',
                $htmlContent
            );

            unset($elements[0]);
            unset($elements[sizeof($elements) - 1]);


            foreach ($elements as $element) {
                $adLink = explode(
                    '?_ref=16',
                    explode('c-jobListView__titleLink" target="_blank" href="', $element)[1]
                )[0];

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

                foreach ($companyElements as $companyElement) {
                    $personnelCountString = explode('</s', str_replace('">', '', $companyElement))[0];

                    if (in_array($personnelCountString, [
                        '۵۱ تا ۲۰۰ نفر',
                        '۵۰۱ تا ۱۰۰۰ نفر',
                        '۲۰۱ تا ۵۰۰ نفر'
                    ])) {
                        $client = new Client();
                        $adLinkResponse = $client->request('GET', $adLink);
                        $adLinkContent = $adLinkResponse->getBody()->getContents();

                        $salary = null;
                        if (strpos($adLinkContent, 'حقوق</h4>')) {
                            $salary = explode(
                                '</span>',
                                explode(
                                    '<span class="black">',
                                    explode(
                                        'حقوق</h4>',
                                        $adLinkContent
                                    )[1]
                                )[1]
                            )[0];
                        }

                        $experience = null;
                        if (strpos(
                            $adLinkContent,
                            'حداقل سابقه کار</h4>'
                        )) {
                            $experience = explode(
                                '</span>',
                                explode(
                                    '<span class="black">',
                                    explode(
                                        'حداقل سابقه کار</h4>',
                                        $adLinkContent
                                    )[1]
                                )[1]
                            )[0];
                        }


                        Link::query()
                            ->updateOrCreate([
                                'link' => $adLink,
                            ], [
                                'salary' => $salary,
                                'experience' => $experience,
                            ]);

                        break;
                    }
                }
            }
        }
    }
}
