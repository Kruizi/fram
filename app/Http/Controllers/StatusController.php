<?php namespace Laravel\Http\Controllers;
use Illuminate\Routing\Controller;
use Laravel\Status;
use Request;

class StatusController extends WelcomeController {
    /**
     * @param Status $status
     */
    public function __construct(Status $status)
    {
        $this->Status = $status;
    }

    /**
     * @return \Illuminate\View\View
     * Проверяем ссылки на доступность
     * Метод работает через роуте
     */
	public function index()
	{
        /** Выводит Все из БД */
        $good = $this->Status->get();
        /** Берем количество ссылок */
        return view('check', compact('good', 'countUrl'));
    }

    /**
     * @return string
     * Этот метод для AJAX
     * Он обновляет, добавляет и выводит ссылки
     */
    private function getMore()
    {
        if (Request::ajax()) {
            $dataRow = array();
            /** Сделаем цикл для обновлении ссылок*/
            $i = $_POST['i'];
            /** Берем саму ссылку*/
            $users = Status::where('id', '=', $i)->addSelect('desc')->get();
            foreach($users as $u)
            {
                /** Проверяем на статус*/
                $goods = get_headers($this->urls().$u->desc);
                /** Обновляем*/
                Status::where('id', '=', $i)->update(['name' => $goods[0]]);
                if($goods[0] === 'HTTP/1.1 302 Found' || $goods[0] == 'HTTP/1.1 404 Not Found'){$danger = 'bg-danger';}else{ $danger='bg-s';}
                return '<p  style="float: left; margin:0;">Эта ссылка: '.$this->urls().$u->desc.'<p style="float: right;margin:0;" class="'.$danger.'">'.$goods['0'].'</p>';
            }
        }
    }
}
