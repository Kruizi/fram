<?php namespace Laravel\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Laravel\People;
use Request;

class WelcomeController extends SettingsController {
    /**
     * @return \Illuminate\View\View
     * Выводим ссылки и добавляем в БД
     */
    public function index()
    {
        /**
         * Возвращает количество уникальных ссылок
         */
        $countDesc = People::allCount();
        /**
         * @return array BD
         */
        $good = People::allData();
        Auth::user();
        return view('index', compact('good', 'countDesc'));
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
