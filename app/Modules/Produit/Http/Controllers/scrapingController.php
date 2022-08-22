<?php

namespace App\Modules\Produit\Http\Controllers;

use \stdClass;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;
use Symfony\Component\HttpClient\HttpClient;
class scrapingController extends Controller
{

    public function scrapingFromEbay()
    {

        $client = new Client(HttpClient::create(['timeout' => 60]));

        $crawler = $client->request('GET', 'https://www.ebay.fr/itm/314078347121?_trkparms=pageci%3Ab9408a57-1a94-11ed-a64a-4213b420711b%7Cparentrq%3A9457cccd1820ad345284605dfffb7f26%7Ciid%3A1');
        $title= $crawler->filter('.x-item-title .x-item-title__mainTitle .ux-textspans')->each(function ($node) {
          //  dump($node->text());
            return $node->text();
        });
        $price = $crawler->filter('.mainPrice .vi-price .notranslate')->each(function ($node) {
           // dump($node->text());
            return $node->text();
        });
        $pricedescount = $crawler->filter('.discountPrice .vi-orig-price-wrapper .vi-originalPrice')->each(function ($node) {
            // dump($node->text());
             return $node->text();
         });
         $quantity = $crawler->filter('.vi-quantity-wrapper .qtyTxt')->each(function ($node) {
            // dump($node->text());
             return $node->text();
         });
        return [
            "title" => $title[0],
            "price" => $price[0],
            "pricedescount" => $pricedescount[0],
            "quantity" => $quantity[0],

            "status" => "200"
        ];
    }

    public function scrapingFromJumia(Request $request)
    {

        $client = new Client(HttpClient::create(['timeout' => 60]));

        $crawler = $client->request('GET', 'https://www.jumia.ma/catalog/?q='.(string)$request->name);


         $listdata= $crawler->filter('.prd .core')->each(function ($node) {

            $title= $node->filter('.info .name')->text();
            $price= $node->filter('.info  .prc')->text();
            $url= $node->attr('href');

            $pricedescount= $node->filter('.info  .s-prc-w .old')->count()? $node->filter('.info  .s-prc-w .old')->text() : null;
            $descount= $node->filter('.info  .s-prc-w ._dsct')->count() ? $node->filter('.info  .s-prc-w ._dsct')->text() : null;

            $produitModule = new stdClass();
            $produitModule->title =$title;
            $produitModule->price =$price;
            $produitModule->pricedescount =$pricedescount;
            $produitModule->descount =$descount;
            $produitModule->url =$url;
            $item =[$produitModule];

            return $item[0];
            // $data->push($item);
             //var_dump($data);
          });

        /* $title= $crawler->filter('.prd .core .info .name')->each(function ($node) {
          //  dump($node->text());
            return $node->text();
        });
        $price = $crawler->filter('.prd .core .info .prc')->each(function ($node) {
           // dump($node->text());
            return $node->text();
        });
        $pricedescount = $crawler->filter('.prd .core .info .s-prc-w .old')->each(function ($node) {
            // dump($node->text());
             return $node->text();
         });
         $descount = $crawler->filter('.prd .core .info .s-prc-w ._dsct')->each(function ($node) {
            // dump($node->text());
             return $node->text();
         });
         $url = $crawler->filter('.prd .core')->each(function ($node) {
            // dump($node->text());
             return $node->attr('href');
         }); */
        return [
            "listdata" => $listdata,
            "status" => "200"
        ];
    }
}
