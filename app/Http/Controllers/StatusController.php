<?php namespace Laravel\Http\Controllers;
use Illuminate\Routing\Controller;
use Laravel\Status;
use Request;

class StatusController extends Controller {
    /**
     * @return \Illuminate\View\View
     * Проверяем ссылки на доступность
     * Метод работает через роуте
     */
	public function index()
	{
        /** Выводит Все из БД */
        $good = Status::get();
        /** Берем количество ссылок */
        $countUrl = Status::where('admin', '=', 0)->count();
        return view('check', compact('good', 'countUrl'));
    }

    /**
     * @return string
     * Этот метод для AJAX
     * Он обновляет, добавляет и выводит ссылки
     */
    public function getMore()
    {
        if (Request::ajax()) {
            $url = 'http://realadmin.ru/';
            $dataRow = array();
            /** Берем количество ссылок в базе*/
            $countUrl = Status::where('admin', '=', 0)->count();
            /** Сделаем цикл для обновлении ссылок*/
            $i = $_POST['i'];
            /** Берем саму ссылку*/
            $users = Status::where('id', '=', $i)->addSelect('desc')->get();
            foreach($users as $u)
            {
                /** Проверяем на статус*/
                $goods = get_headers('http://realadmin.ru/'.$u->desc);
                /** Обновляем*/
                Status::where('id', '=', $i)->update(['name' => $goods[0]]);
                if($goods[0] === 'HTTP/1.1 302 Found'){$danger = 'bg-danger';}else{ $danger='bg-s';}
                return '<p  style="float: left; margin:0;">Эта ссылка: '.$url.$u->desc.'<p style="float: right;margin:0;" class="'.$danger.'">'.$goods['0'].'</p>';
            }
        }
    }
}
