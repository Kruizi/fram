<?php namespace Laravel\Http\Controllers;

use Laravel\Http\Requests;
use Illuminate\Database\Schema\Blueprint;
use DB;
use Schema;

class SettingsController extends Controller {
    /**
     * @return string
     * URL сайта
     * -----------------------------------------------------------------------
     * ИСПРАВИТЬ ЧТОБЫ МОЖНО БЫЛО ВЗЯТЬ ИЗ БД
     * или при клике
     */
    public function urls($url){
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
    /**
     * Берем скорость загрузки страницы
     * Размер загружаемого сайта
     */
     public function staticWeb($url){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1 );
        curl_exec($ch);
        if(!curl_errno($ch))
        {
            $info = curl_getinfo($ch);
            if($info['http_code'] == '200'){
                $http_code = 'доступен';
            }
            /**
             * Проверку на доступность сайта
             */
            DB::update('update clients set status = 0 where web_clients = ?', [$url]);                      
            return [$http_code,$info['connect_time'],$info['total_time'],$info['size_download']];
        }else
        {
            DB::update('update clients set status = 2 where web_clients = ?', [$url]); 
            return ['недоступен', 'сайт недоступен, скорость не определена', 'сайт недоступен, скорость не определена', 'сайт недоступен, размер не определена'];               
        }
     }
    
    /**
     * Изменяем размер который к нам придет переводим его в понятный размер
     */    
    public function format_size($size, $type=0) {
        if ($type == 0) {
                $iec = array('байт', 'Килобайт', 'Мегабайт', 'Гигабайт', 'Терабайт', 'Петабайт', 'Эксабайт');
        }
        $i = 0;
        while (($size/1024)>1) {
                $size = $size/1024;
                $i++;
        }
        $echo = round($size).' '.$iec[$i];
        return $echo;
    }
    
    /**
     * Делаем изображение сайта
     * Как сайт выглядит и установим правило чтобы он обновлял картинку только каждые 5 часов при заходе на сайт
     */
     public function imgWeb($imgWebArray){
        /** Текущию дату и дату которая записана в БД мы представляем даты на английском языке в метку времени Unix
          * И проверяем что прошло 5 часов */
        if(strtotime(date("Y-m-d H:i:s")) - strtotime($imgWebArray->imgDate) > 18000){
            /** Куда сохраняем картинку */
            $fp = fopen('sceenshots/'.$imgWebArray->webNameClients.'.png', 'w');
            /** Бере саму картинку */
            fwrite($fp, file_get_contents('http://mini.s-shot.ru/1280x1600/png/?'.$imgWebArray->webClients));
            /** Закрываем файл */
            fclose($fp);
            /** Записываем текущию дату в БД */
            DB::update('update clients set img_date = "'.date("Y-m-d H:i:s").'" where indeficators = ?', [$imgWebArray->indeficators]);            
        }
    }
    /**
     * @param $url
     * @return mixed
     * Заносим дату активности сайта (доступности)
     */
    protected function checkWeb()
    {
        $ind = htmlspecialchars(strip_tags($_POST['indeficator']));
        $start = htmlspecialchars(strip_tags($_POST['start']));
        $end = htmlspecialchars(strip_tags($_POST['end']));
        //Сначала сделаем проверку на существование таблицы для этого возьмем всех клиентов
        $array_ind = DB::table('clients')->where('indeficators', '=', $ind)->get();
        //Сделаем массив в котором будет содержаться array в формат JSON
        $data = [];
        //Проверка на существование таблицы
        if(Schema::hasTable('date_'.$ind) == false)
        {
                //Если нету то создадим
                Schema::create('date_'.$ind, function(Blueprint $table)
                {
                    $table->bigIncrements('id', 11);
                    $table->text('url');
                    $table->string('status', 11);
                    $table->text('descriptions');
                    $table->string('indeficators', 255);
                    $table->date('data');
                });
        }else
        {
                //если есть сделаем проверку на то что она не пустая
                if(DB::table('date_'.$ind)->count() != 0)
                {
                    if (isset($start) AND isset($end)) {
                    	$data = array();
                        $results = DB::select('select data,status from date_'.$ind.' where data >= ? OR data <= ?', array($start,$end));         
                    	// Build a new array with the data
                    	foreach ($results as $key => $value) {
                    		$data[$key]['label'] = $value->data;
                    		$data[$key]['value'] = $value->status;
                   	    }
                    
                   	echo json_encode($data);
                }
            }    
        }
    }

}
