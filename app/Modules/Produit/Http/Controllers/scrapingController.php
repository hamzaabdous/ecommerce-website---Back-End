<?php

namespace App\Modules\Produit\Http\Controllers;

use \stdClass;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;
use Symfony\Component\HttpClient\HttpClient;
class scrapingController extends Controller
{

    public function scrapingFromEbay()
    {
       // $listdata= $crawler->filter('.s-card-container .a-section .sg-row .sg-col .sg-col-inner .a-section .sg-row .s-price-instructions-style .a-row .s-color-discount')->each(function ($node) {

        $client = new Client(HttpClient::create(['timeout' => 60]));

        $crawler = $client->request('GET', 'https://www.amazon.com/s/ref=nb_sb_noss_2?url=search-alias%3Daps&field-keywords=samsung&crid=29QTR5Y3BQ21D&sprefix=samsung%2Caps%2C167');
        $listdata= $crawler->filter('.s-card-container .a-section .sg-row .sg-col .sg-col-inner .s-product-image-container .aok-relative .rush-component .a-link-normal .s-image-fixed-height')->each(function ($node) {

           // $img= $node->filter('.s-image')->count()? $node->filter('.s-item__image-section  .s-item__image .s-item__image-wrapper .s-item__image-img')->attr('src') : null;
            $img= $node->filter('.s-image')->attr('class');
            var_dump($img);
          /*   $produitModule = new stdClass();
            $produitModule->img =$img;

            $item =[$produitModule];

            return $item[0]; */
            // $data->push($item);
             //var_dump($data);
          });


        /* $title= $crawler->filter('.x-item-title .x-item-title__mainTitle .ux-textspans')->each(function ($node) {
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
         }); */
      /*   return [
            "listdata" => $listdata,


            "status" => "200"
        ]; */
    }

    public function scrapingFromJumia(Request $request)
    {

        $client = new Client(HttpClient::create(['timeout' => 60]));

        $crawler = $client->request('GET', 'https://www.jumia.ma/catalog/?q='.(string)$request->name);


         $listdata= $crawler->filter('.prd .core')->each(function ($node) {

            $title= $node->filter('.info .name')->text();
            $price= $node->filter('.info  .prc')->text();
            $url= $node->attr('href');
            $img= $node->filter('.img')->attr('src');

            $pricedescount= $node->filter('.info  .s-prc-w .old')->count()? $node->filter('.info  .s-prc-w .old')->text() : null;
            $descount= $node->filter('.info  .s-prc-w ._dsct')->count() ? $node->filter('.info  .s-prc-w ._dsct')->text() : null;

            $produitModule = new stdClass();
            $produitModule->title =$title;
            $produitModule->price =$price;
            $produitModule->pricedescount =$pricedescount;
            $produitModule->descount =$descount;
            $produitModule->img =$img;

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
