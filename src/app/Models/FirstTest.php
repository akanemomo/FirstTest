<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirstTest extends Model
{
    use HasFactory;

    // contacts テーブルの操作可能なカラムを設定
    protected $fillable = [
        'category_id',  // 外部キー（categoriesテーブル）
        'user_id',      // 外部キー（usersテーブル）
        'first_name',   // 名前（姓）
        'last_name',    // 名前（名）
        'gender',       // 性別
        'email',        // メールアドレス
        'tel',          // 電話番号
        'address',      // 住所
        'building',     // 建物名
        'detail',       // 詳細
    ];

    // categories テーブルとのリレーションを定義
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // users テーブルとのリレーションを定義
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

