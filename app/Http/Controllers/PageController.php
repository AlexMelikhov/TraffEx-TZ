<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response;

//use App\Http\Controllers\StatController;


/**
 * Class SiteController
 * @package App\Http\Controllers
 *
 * Контроллер вывода страниц сайта
 */

class PageController extends Controller {


    public function __construct() {
    }

    public function showPage($pageID, Request $request) {


        $response = response(view('page', ['topMenu' => $this->generatePageMenu($pageID),'content' => 'PageNum #'.$pageID, 'pageID' => $pageID]));

        $response = $this->performHit($pageID, $request, $response);

        return $response;
        
    }


    /**
     * Генерация меню
     * @param $pageID
     * @todo по хорошему отсюда это нужно вынести, учитывая что это ТЗ оставил тут
     */

    private function generatePageMenu($pageID){

        $topmenu = '';

        for ($x=1;$x<=10;$x++){
            $topmenu .= '<li'.($x == $pageID ? ' class="active"' : '').'><a href="/sitepage'.$x.'">Page'.$x.'</a></li>'.PHP_EOL;
        }

        return $topmenu;
    }

    /**
     * Просмотр страницы. Вообще я бы вынес в трейт который подключал бы к нужным контроллерам. но т.к. пока он один - оставил тут.
     */
    private function performHit($pageID, Request $request, Response $response){
        
        if ($pageID){
            $stats = new AdminController();
            return $stats->performHit($pageID, $request,$response);
        } else {
            return $response;
        }

    }
}
