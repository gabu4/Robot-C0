<?php

use module\crawler\pages;
use cbcore\out\console as cbconsole;

class smart_baby_hu extends pages
{

    public string $url_data;

    function __construct(cbconsole $console, $whatStageILoad)
    {
        parent::__construct($console, $whatStageILoad);

        $this->workingdir = "./cb-results/smart_baby_hu/";
        $this->url = "https://smart-baby.hu/";
        $this->url_data = "https://smart-baby.hu/termekek/";

        $stage = $this->stage;
        return $this->$stage();
    }

    protected function f_test()
    {
        global $console;

        $console->nt("... page crawling in progress ...");
        $console->pc();

        $pageNumbers = 0;
        $processCountCounter = 1;
        $elemCounter = 0;

        $this->httpClient = new \Goutte\Client();
        $outputJson = [];

        if (!empty($this->url)) {

            $url = $this->url;

            $currentPage = 1;

            $response = $this->httpClient->request('GET', $url);

            $pageNumbers = $response->filter('.category_card')->first()->html();

            print_r($pageNumbers);

            exit;
        }
    }

    protected function f_initial()
    {
        global $console;

        $console->ntc("... page crawling in progress ...");
        $categoryList = [];

        if (!empty($this->url_data)) {
            $response = $this->httpClient->request('GET', $this->url_data);

            $response->filter('#category_grid .category_card')->each(function ($node) use (&$console, &$categoryList) {
                $text = $node->filter('.info_title a')->text();
                $href = $this->urlFromLink($node->filter('.info_title a')->attr('href'));
                $image = $this->urlFromLink($node->filter('.img_wrap img')->attr('src'));
                $count = str_replace(' Termékek', '', $node->filter('.info_count .count')->text());
                $console->ntc("Founded main category: " . $text . " (" . $href . ")");
                $categoryList[crc32($text)] = [
                    'main_category_name' => $text,
                    'main_category_url' => $href,
                    'main_category_image' => $image,
                    'product_count' => $count,
                    'subcategory' => $this->f_initial_getSubCategory($href, $text)
                ];
            });

            $jsonData = json_encode($categoryList);
            file_put_contents($this->workingdir . "category_list.json", $jsonData);

            $console->ntc("Done ...");

            return true;
        }

        $console->ntc(".forth.");
    }

    protected function f_initial_getSubcategory($url, $maincatname)
    {
        global $console;

        $this->sleep();
        $categoryList = [];

        $response = $this->httpClient->request('GET', $url);
        $response->filter('#category_grid .category_card')->each(function ($node) use (&$console, &$categoryList, $maincatname) {
            $text = $node->filter('.info_title a')->text();
            $href = $this->urlFromLink($node->filter('.info_title a')->attr('href'));
            $image = $this->urlFromLink($node->filter('.img_wrap img')->attr('src'));
            $count = (int)trim(str_replace(' Termékek', '', $node->filter('.info_count .count')->text()));
            $console->ntc(" |__ Founded sub category: " . $text . " (" . $href . ")");
            $categoryList[crc32($text)] = [
                'main_category_name' => $maincatname,
                'category_name' => $text,
                'category_image' => $image,
                'product_count' => $count,
                'category_url' => $href
            ];
        });

        return $categoryList;
    }

    protected function f_crawl_productlist()
    {
        global $console;

        if (!is_file($this->workingdir . "category_list.json")) {
            $console->ntc("Run mapping first!\n\n");
            return false;
        }

        $strJsonFileContents = file_get_contents($this->workingdir . "category_list.json");
        $array = json_decode($strJsonFileContents, true);

        $outputJson = [];

        $console->ntc("... product list download in progress");

        $amount = 0;

        $productId = 1;

        if (!empty($array)) {
            foreach ($array as $array2) {
                foreach ($array2['subcategory'] as $crcKey => $product) {
                    $this->sleep();

                    $outputJson[$productId]['main_category_name'] = $mname = $product['main_category_name'];
                    $outputJson[$productId]['category_name'] = $name = $product['category_name'];
                    $outputJson[$productId]['category_url'] = $url = $product['category_url'];
                    $outputJson[$productId]['category_image'] = $product['category_image'];

                    $pageNumbers = ceil($product['product_count'] / 12);

                    for ($processCountCounter = 1; $processCountCounter <= $pageNumbers; $processCountCounter++) {
                        $this->sleep();
                        $amount++;
                        $response = $this->httpClient->request('GET', $url . '?page=' . $processCountCounter);

                        $console->ntc("Search products on page " . $mname . " > " . $name . " (" . $url . '?page=' . $processCountCounter . ")");

                        $response->filter('div#main.main_product_list .product_card')->each(function ($node) use (&$console, &$productList, &$outputJson, &$productId, $amount) {
                            $outputJson[$productId]['product_url'] = $product_url = $this->urlFromLink($node->filter('.name a')->attr('href'));;
                            $outputJson[$productId]['thumbnail_image'] = $this->urlFromLink($node->filter('.figure img')->attr('src'));
                            $outputJson[$productId]['product_name'] = $product_name = trim($node->filter('.name h2')->text());
                            $outputJson[$productId]['product_price'] = 0;
                            if ($node->filter('.price .new_price')->count() > 0) {
                                $outputJson[$productId]['product_price'] = trim($node->filter('.price .new_price .money_expanded')->text());
                            }
                            $outputJson[$productId]['product_price_action'] = 'false';
                            if ( $node->filter('.price .old_price_post')->count() > 0 && $node->filter('.price .old_price_post.hidden')->count() === 0) {
                                $outputJson[$productId]['product_price_action'] = 'true';
                                $outputJson[$productId]['product_price_old'] = trim($node->filter('.price .old_price_post .money_expanded')->text());
                            }

                            $details = $this->f_crawl_productlist_details($product_url);

                            $outputJson[$productId] = array_merge($outputJson[$productId], $details);

                            $console->ntc(" Founded product: #" . $productId . " \"" . $product_name . "\" (" . $product_url . ")");

                            $productId++;

                            $jsonData = json_encode($outputJson);
                            file_put_contents($this->workingdir . "product_list.json", $jsonData);
                        });

                        $jsonData = json_encode($outputJson);
                        file_put_contents($this->workingdir . "product_list.json", $jsonData);
                    }

                    $jsonData = json_encode($outputJson);
                    file_put_contents($this->workingdir . "product_list.json", $jsonData);
                }
            }

            $jsonData = json_encode($outputJson);
            file_put_contents($this->workingdir . "product_list.json", $jsonData);

            $console->ntc("Done ...");

            exit;
        }
    }

    protected function f_crawl_productlist_details($product_url)
    {
        global $console;

        $this->sleep();
        $detailsArray = [];

        $response = $this->httpClient->request('GET', $product_url);

        $detailsArray['product_name'] = trim($response->filter('#product_title')->text());
        $detailsArray['product_code'] = trim(str_replace(['Csomagkód', ':'], ['', ''], $response->filter('#product_id')->text()));
        $detailsArray['product_in_stock'] = trim($response->filter('.stock_info>div')->attr('class'));
        $detailsArray['product_in_stock_text'] = $response->filter('meta[property="product:availability"]')->attr('content');

        $detailsArray['product_description'] = trim($response->filter('.product_section_content .description')->text());
        $detailsArray['product_specs'] = [];

        if ($response->filter('.product_section_content .specs_table .product_tab_table_specs')->count() > 0) {
            $response->filter('.product_section_content .specs_table .product_tab_table_specs tr')->each(function ($node) use (&$console, &$detailsArray) {
                $detailsArray['product_specs'][] = [
                    'text' => trim($node->filter('td')->first()->text()),
                    'value' => trim($node->filter('td')->last()->text())
                ];
            });
        }

        $detailsArray['product_info'] = "";
        if ($response->filter('#product_info_desc .desc')->count() > 0) {
            $detailsArray['product_info'] = trim($response->filter('#product_info_desc .desc')->text());
        }

        $detailsArray['product_images'] = [];
        $imgArrayKeys = [];
        $response->filter('#product_gallery_main .item')->each(function ($node) use (&$console, &$detailsArray, &$imgArrayKeys) {
            if ( !isset($imgArrayKeys[crc32($this->urlFromLink($node->filter('a')->attr('href')))]) ) {
                $imgArrayKeys = crc32($this->urlFromLink($node->filter('a')->attr('href')));
                $detailsArray['product_images'][] = $this->urlFromLink($node->filter('a')->attr('href'));
            }
        });

        return $detailsArray;
    }
}