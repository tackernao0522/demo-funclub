<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    const STATUS = [
        1 => ['label' => '未対応', 'class' => 'btn-danger'],
        2 => ['label' => '対応済', 'class' => 'btn-info'],
    ];

    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'your_name',
        'your_email',
        'your_message',
    ];

    /**
     * 状態のラベル
     * @return string
     */
    public function getStatusLabelAttribute()
    {

        // 状態値
        $status = $this->attributes['status'];

        // 定義されていなければ空文字を返す
        if (!isset(self::STATUS[$status])) {
            return '';
        }

        return self::STATUS[$status]['label'];
    }

    /**
     * 状態を表すHTMLクラス
     * @return string
     */
    public function getStatusClassAttribute()
    {
        // 状態値
        $status = $this->attributes['status'];

        // 定義されていなければ空文字を返す
        if (!isset(self::STATUS[$status])) {
            return '';
        }

        return self::STATUS[$status]['class'];
    }
}
