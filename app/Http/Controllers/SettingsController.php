<?php namespace Laravel\Http\Controllers;

use Laravel\Http\Requests;

class SettingsController extends Controller {
    /**
     * @return string
     * URL сайта
     * -----------------------------------------------------------------------
     * ИСПРАВИТЬ ЧТОБЫ МОЖНО БЫЛО ВЗЯТЬ ИЗ БД
     * или при клике
     */
    public function urls(){
        $url = "http://web-sellers.ru";
        if (preg_match('/^(http|https):\/\/([A-Z0-9][A-Z0-9_-]*(?:.[A-Z0-9][A-Z0-9_-]*)+):?(d+)?/i', $url)) {
            return $url;
        } else {
            abort(404);
        }
    }

    /**
     * @return array
     * Парсим ссылки
     */
    protected function isDomainAvailible($url)
    {
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL,$url);// ссылка
        curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6"); //агент которым мы представимся
        curl_setopt ($ch, CURLOPT_TIMEOUT, 15 ); // таймаут
        curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec ($ch);
        curl_close($ch);
        // Находим и сохраняем нужный фрагмент
        preg_match_all('/<(?:[aA][\s]+[hH][rR][eE][fF]|[iI][mM][gG][\s]+.*[\s]+[sS][rR][cC])[\s]*=[\s]*[\'"]([^\s">]+)[\'"]/',$result,$links);
        return $links; //возвращаем  полученную страницу

    }

    /**@return int Количество символов в нашем url*/
    public function num(){return strlen($this->urls());}

    /**
     * @return array
     * Возвращаем массив ссылок
     */
    public function arrayUrl($url)
    {
        $isDomainAvailible = $this->isDomainAvailible($url);
        return $isDomainAvailible;
    }

    /**
     * @param $http
     * @return mixed
     * обрезает ссылку убираем адрес
     */
    public function strReplace($http)
    {
        if(strripos($http, 'htt') == 'true')
        {
            if(stripos($http, 'metrika') == 'true')
            {
                return 'метрика';
            }else{
                return parse_url($http, PHP_URL_PATH);
            }
        }else{
            return $http;
        }
    }

}
