<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    // マスアサインメント保護
    protected $fillable = [
        'first_name', 'last_name', 'gender', 'email', 'tel', 'address', 'category_id', 'detail'
    ];

    // 日付フィールドを自動的にCarbonインスタンスに変換
    protected $dates = ['created_at', 'updated_at'];

    /**
     * ContactとCategoryのリレーションシップ
     */
    public function category()
    {
        return $this->belongsTo(Category::class);  // ContactはCategoryに所属
    }
}

