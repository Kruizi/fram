<?php namespace Laravel\Http\Controllers;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Laravel\People;
use Request;
use DB;

class WelcomeController extends SettingsController {
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    { 
        $this->middleware('auth');
    }

    public function index(Authenticatable $user )
    {
            $name = $user->name;
            $client = DB::table('clients')->get();
            $ind = People::countBDnot();
            $notification = People::notification();
            $title = 'Главная';
            return view('index', compact('name','client', 'ind', 'notification', 'title'));       
    }

    public function status($id,Authenticatable $user )
    {
        $name = $user->name;
        $ind = People::countBDnot();
        $notification = People::notification();
        $info_clients = DB::table('clients')->where('indeficators', $id)->first();    
        $imgWebArray = (object)['webClients' => $info_clients->web_clients,
                        'webNameClients' => $info_clients->name_clients,
                        'imgDate' => $info_clients->img_date,
                        'indeficators' => $info_clients->indeficators]; 
        $dd = $this->staticWeb($info_clients->web_clients);              
        $format_size = $this->format_size($dd[3]);
        $this->imgWeb($imgWebArray);
        $title = $info_clients->name_clients;
        return view('edit', compact('info_clients', 'name', 'dd', 'ind', 'notification', 'format_size', 'title'));
    }

    public function getUrl(){
        if (Request::ajax()) {
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
                for ($i = 0; $i < count($isDomainAvailible['1']); $i++) {
                    /**
                     * через strReplace достаем все что после http://example.ru/то что нужно взять/
                     */
                    $http = $this->strReplace($isDomainAvailible['1'][$i]);
                        /**
                         * Ищем в БД схожие записи
                         */
                        if (People::countBD($http) == '0') {
                            /**
                             * Добавляем в БД нынешнию запись и настоящию
                             */
                            People::whereInsert($http, $isDomainAvailible['1'][$i]);
                            return '<p>' . $isDomainAvailible['1'][$i] . '</p>';
                        }
                        /**
                         * Делаем поиск ссылок которые есть в БД
                         * И в них ищим другие ссылки которых нет в БД
                         */
                        $isDomainAvailibleCub = $this->isDomainAvailible($this->urls() . $http);
                        /**
                         * Делаем массив который будет добавлять новые ссылки в БД
                         */
                        foreach ($isDomainAvailibleCub[1] as $is) {
                            $is_rep = $this->strReplace($is);

                            if (People::countBD($is_rep) == '0') {
                                People::whereInsert($is_rep, $is);
                                return '<p>' . $is_rep . '</p>';
                            }
                        }
                    }
            } else {
                return '<p>Ошибка при парсинге сайта</p>';
            }
        }
    }

}
