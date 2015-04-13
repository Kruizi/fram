<?php namespace Laravel\Http\Controllers;
use Illuminate\Routing\Controller;
use Laravel\People;
use Request;
class WelcomeController extends Controller {

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
    private function isDomainAvailible($url)
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
    /**
     * @return int
     * Количество символов в нашем url
     */
    public function num(){
        return strlen($this->urls());
    }

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
       return parse_url($http, PHP_URL_PATH);
    }

    /**
     * @param $url
     * @return mixed
     * количество одинаковых названий в БД
     */
    public function countBD($url)
    {
        return People::where('desc', '=', ''.$url.'')->count();
    }

    /**
     * @param $where
     * добавляем в БД обрезанную строку и оригинальную
     */
    public function whereInsert($where,$where_orig)
    {
        People::insertGetId(array('desc' => ''.$where.'', 'original_url' => ''.$where_orig.''));
    }

    /**
     * @return \Illuminate\View\View
     * Выводим ссылки и добавляем в БД
     */
    public function index()
    {
        /**
         * Ловим массив с ссылками
         */
        $isDomainAvailible = $this->arrayUrl($this->urls());
        /**
         * Делаем проверку на пустоту
         */
        if (!empty($isDomainAvailible)) {
            /**
             * Делаем цикл
             */
            for($i = 0; $i < count($isDomainAvailible['1']); $i++)
            {
                /**
                 * проверяем есть ли в нашей строке "http|https"
                 */
                if(strripos($isDomainAvailible['1'][$i], 'htt') == 'true')
                {
                    /**
                     * через strReplace достаем все что после http://example.ru/то что нужно взять/
                     */
                    $http = $this->strReplace($isDomainAvailible['1'][$i]);
                    /**
                     * Ищем в БД схожие записи
                     */
                    if ($this->countBD($http) == '0')
                        {
                            /**
                             * Добавляем в БД нынешнию запись и настоящию
                             */
                            $this->whereInsert($http,$isDomainAvailible['1'][$i]);
                        }
                            /**
                             * Делаем поиск ссылок которые есть в БД
                             * И в них ищим другие ссылки которых нет в БД
                             */
                            $isDomainAvailibleCub = $this->isDomainAvailible($this->urls().$http);
                            /**
                             * Делаем массив который будет добавлять новые ссылки в БД
                             */
                            foreach($isDomainAvailibleCub[1] as $is)
                            {
                                        $is_rep = $this->strReplace($is);

                                        if($this->countBD($is_rep) == '0')
                                        {
                                            $this->whereInsert($is_rep,$is);
                                        }
                            }
                }else
                {
                    /**
                     * через strReplace достаем все что после http://example.ru/то что нужно взять/
                     */
                    $http = $this->strReplace($isDomainAvailible['1'][$i]);
                    /**
                     * Ищем в БД схожие записи
                     */
                    if ($this->countBD($http) == '0')
                    {
                        /**
                         * Добавляем в БД нынешнию запись и настоящию
                         */
                        $this->whereInsert($http,$isDomainAvailible['1'][$i]);
                    }
                    /**
                     * Делаем поиск ссылок которые есть в БД
                     * И в них ищим другие ссылки которых нет в БД
                     */
                    $isDomainAvailibleCub = $this->isDomainAvailible($this->urls().$http);
                    /**
                     * Делаем массив который будет добавлять новые ссылки в БД
                     */
                    foreach($isDomainAvailibleCub[1] as $is)
                    {
                        $is_rep = $this->strReplace($is);

                        if($this->countBD($is_rep) == '0')
                        {
                            $this->whereInsert($is_rep,$is);
                        }
                    }
                }
            }
            }else
            {
                $good = 'Error array';
            }
        /**
         * Возвращает количество уникальных ссылок
         */
        $countDesc = People::where('admin', '=', '0')->count();
        /**
         * @return array BD
         */
        $good = People::get();

        return view('index', compact('good', 'countDesc'));
    }

}
