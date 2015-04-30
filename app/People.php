<?php namespace Laravel;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Schema\Blueprint;
use DB;
use Schema;
class People extends Eloquent {
    /**
     * @param $url
     * @return mixed
     * количество одинаковых названий в БД
     */
    static function countBD($url)
    {
        return People::where('desc', '=', ''.$url.'')->count();
    }
    /**
     * Выводим уведомление
     */
    static function notification()
    {
        $array_ind = DB::table('clients')->get();
        $notification = [];
        $get_notification = [];
        foreach($array_ind as $not)
        {
            $notification[] = $not->indeficators;
        }
        for($i = 0; $i < count($notification); $i++)
        {
            if(Schema::hasTable('notification_'.$notification[$i]) == true)
            {
                if(DB::table('notification_'.$notification[$i])->count() != '0')
                {
                    $get_notifications = DB::table('notification_'.$notification[$i])->where('status', '>', 0)->get();
                    foreach($get_notifications as $not)
                    {
                        $get_notification[] = $not;
                    }
                }
            }

        }
        return $get_notification;
    }
    /**
     * @param $url
     * @return mixed
     * количество уведомлений
     */
    static function countBDnot()
    {
        $array_ind = DB::table('clients')->get();
        $count = [];
        for($i = 0; $i < count($array_ind); $i++)
        {
            if(Schema::hasTable('notification_'.$array_ind[$i]->indeficators) == false)
            {
                Schema::create('notification_'.$array_ind[$i]->indeficators, function(Blueprint $table)
                {
                    $table->bigIncrements('id', 11);
                    $table->text('url');
                    $table->string('status', 11);
                    $table->text('descriptions');
                    $table->string('indeficator', 255);
                    $table->dateTime('date_notification');
                });
            }else
            {
                if(DB::table('notification_'.$array_ind[$i]->indeficators)->count() != 0)
                {
                    $count[$i] = (DB::select('select * from notification_'.$array_ind[$i]->indeficators.' where status = ?', [1]));
                }    
            }
            
        }
        $ind = array_merge($count);
        for($i=0; $i < count($ind); $i++){$arr[$i] = explode(" ", count($ind[$i]));}
        $summ = 0;
        if(isset($arr))
        {foreach($arr as $v){$summ += $v[0];}}
        return $summ;
    }
    /**
     * @param $where
     * добавляем в БД обрезанную строку и оригинальную
     */
    static function whereInsert($where,$where_orig)
    {
        People::insertGetId(array('desc' => ''.$where.'', 'original_url' => ''.$where_orig.''));
    }
    /**
     * Возвращает количество уникальных ссылок
     */
    static function allCount(){
        return People::where('admin', '=', '0')->count();
    }
    /**
     * @return array BD
     */
    static function allData(){
        return People::get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    
    static function AllDataPeople(){
        return People::allData();
    }
}
