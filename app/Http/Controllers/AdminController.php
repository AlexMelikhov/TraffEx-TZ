<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Redis;

/**
 * Class AdminController
 * @package App\Http\Controllers
 *
 * Контроллер админки (по совместительству статистики, для ТЗ не стал разделять отдельно, хотя по хорошему нужно)
 */

class AdminController extends Controller {

    private $redis;

    public function __construct() {
        $this->redis = app()->make('redis');

        //$user = Auth::us
    }

    public function showMain (Request $request){

        $view = view('admin/stattable', ['stats'=>$this->_loadStats(0)]);
        $stattable = $view->render();


        $response = response(view('admin/main', ['content'=>$stattable,'statOfPage'=>'Весь сайт','statNav'=>$this->generatePageMenu(0)]));

        return $response;
    }

    public function showPage ($page, Request $request){


        $view = view('admin/stattable', ['stats'=>$this->_loadStats($page)]);
        $stattable = $view->render();



        $response = response(view('admin/main', ['content'=>$stattable,'statOfPage'=>'Страница #'.$page,'statNav'=>$this->generatePageMenu($page)]));

        return $response;
    }



    private function generatePageMenu($pageID){

        $nav = ($pageID == 0) ? '<li role="presentation" class="active"><a href="/admin">Весь сайт</a></li>' : '<li role="presentation"><a href="/admin">Весь сайт</a></li>';

        for ($x=1;$x<=10;$x++){
            $nav .= '<li'.($x == $pageID ? ' class="active"' : '').'  role="presentation"><a href="/admin/sitepage'.$x.'">Page'.$x.'</a></li>'.PHP_EOL;
        }

        return $nav;
    }


    /**
     * показ любой страницы
     * @param $pageID
     * @param Request $request
     */
    public function performHit($pageID, Request $request, Response $response){

        $hit = [
            'hittype' => null,
            'page' => 0, // main
            'metric' => null,
            'val' => null
        ];


        // Cookies

        $is_cookies_site = ($request->cookie('statHit')) ? true : false;
        $is_cookies_page = ($request->cookie('statHit'.$pageID)) ? true : false;

        if (!$is_cookies_site) $response->withCookie(cookie('statHit', 1, 1440));
        if (!$is_cookies_page) $response->withCookie(cookie('statHit'.$pageID, 1, 1440));


        // Check params
        $ip = request()->ip();
        $ua = $_SERVER["HTTP_USER_AGENT"];
        $browser = $this->_getBrowser($ua);
        $os = $this->_getOS($ua);
        $ref =  (isset($_SERVER['HTTP_REFERER'])) ? $this->_getRef($_SERVER["HTTP_REFERER"]) : '';


        $metrics = array('browser' => $browser, 'os' => $os, 'ref' => $ref);


        $storedIPPage = "storedip|{$pageID}|{$ip}";
        $storedIPSite = "storedip|0|{$ip}";

        /**
         * Hosts
         */

        if (!$this->redis->exists($storedIPPage)){

            foreach ($metrics as $k => $v) {
                $this->_writeHit(['hittype'=>'host','page'=>$pageID,'metric'=>$k,'val'=>$v]);
            }

            $this->redis->set($storedIPPage,1);
        }

        if (!$this->redis->exists($storedIPSite)){

            foreach ($metrics as $k => $v) {
                $this->_writeHit(['hittype'=>'host','page'=>0,'metric'=>$k,'val'=>$v]);
            }

            $this->redis->set($storedIPSite,1);
        }

        foreach ($metrics as $k => $v) {

            /**
             * Hits
             */

            // site
            $this->_writeHit(['hittype'=>'hit','page'=>0,'metric'=>$k,'val'=>$v]);
            // page
            $this->_writeHit(['hittype'=>'hit','page'=>$pageID,'metric'=>$k,'val'=>$v]);


            /**
             * Cookie Unique
             */
            if (!$is_cookies_site){
                // site
                $this->_writeHit(['hittype'=>'cookie','page'=>0,'metric'=>$k,'val'=>$v]);
                // page
                $this->_writeHit(['hittype'=>'cookie','page'=>$pageID,'metric'=>$k,'val'=>$v]);

            }


        }


        return $response;

    }


    /**
     * Запись в редис
     * @param array $hit
     */
    private function _writeHit(array $hit){

        /**
         * Ключ - параметры, значение - инкрементальный счетчик
         */

        $key = $hit['hittype'].':'.$hit['page'].':'.$hit['metric'].':'.$hit['val'];
        //$keysum = $hit['hittype'].':'.$hit['page'].':'.$hit['metric'].'s';

            $this->redis->incr($key);



    }



    private function _getBrowser($ua) {

        $browser        =   "Unknown Browser";

        $browser_array  =   array(
          '/msie/i'       =>  'Internet Explorer',
          '/firefox/i'    =>  'Firefox',
          '/safari/i'     =>  'Safari',
          '/chrome/i'     =>  'Chrome',
          '/opera/i'      =>  'Opera',
          '/netscape/i'   =>  'Netscape',
          '/maxthon/i'    =>  'Maxthon',
          '/konqueror/i'  =>  'Konqueror',
          '/mobile/i'     =>  'Handheld Browser'
        );

        foreach ($browser_array as $regex => $value) {
            if (preg_match($regex, $ua)) {
                $browser    =   $value;
            }
        }
        return $browser;
    }

    private function _getOS($ua) {

        global $user_agent;

        $os_platform    =   "Unknown OS Platform";

        $os_array       =   array(
          '/windows nt 6.2/i'     =>  'Windows 8',
          '/windows nt 6.1/i'     =>  'Windows 7',
          '/windows nt 6.0/i'     =>  'Windows Vista',
          '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
          '/windows nt 5.1/i'     =>  'Windows XP',
          '/windows xp/i'         =>  'Windows XP',
          '/windows nt 5.0/i'     =>  'Windows 2000',
          '/windows me/i'         =>  'Windows ME',
          '/win98/i'              =>  'Windows 98',
          '/win95/i'              =>  'Windows 95',
          '/win16/i'              =>  'Windows 3.11',
          '/macintosh|mac os x/i' =>  'Mac OS X',
          '/mac_powerpc/i'        =>  'Mac OS 9',
          '/linux/i'              =>  'Linux',
          '/ubuntu/i'             =>  'Ubuntu',
          '/iphone/i'             =>  'iPhone',
          '/ipod/i'               =>  'iPod',
          '/ipad/i'               =>  'iPad',
          '/android/i'            =>  'Android',
          '/blackberry/i'         =>  'BlackBerry',
          '/webos/i'              =>  'Mobile'
        );

        foreach ($os_array as $regex => $value) {

            if (preg_match($regex, $ua)) {
                $os_platform    =   $value;
            }

        }

        return $os_platform;

    }

    private function _getRef($ref){

        $refhost = 'unknown';

        if ($array = parse_url(urldecode($ref)))
            $refhost = $array['host'];

        return $refhost;


    }


    /**
     *
     * Загружаем статистику по странице
     *
     * @param $pageID
     * @return array
     */


    private function _loadStats ($pageID){
        $stats = [];

        //$stats['os'];

        $metr = ['os','browser','ref'];

        foreach ($metr as $m){
            $mt = $this->redis->keys("*:{$pageID}:{$m}:*");
            foreach ($mt as $k) {
                list ($hittype,$v) = explode(":{$pageID}:{$m}:",$k);
                $stats[$m][$v][$hittype] = $this->redis->get($k);
            }
        }

        return $stats;
    }


}
