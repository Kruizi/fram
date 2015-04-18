<?php namespace Laravel;

use Illuminate\Database\Eloquent\Model as Eloquent;

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

}
