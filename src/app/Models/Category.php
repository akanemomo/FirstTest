<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // マスアサインメント保護
    protected $fillable = ['content'];  // 必要なフィールドを指定

    // 日付フィールドを自動的にCarbonインスタンスに変換
    protected $dates = ['created_at', 'updated_at'];

    /**
     * CategoryとContactのリレーションシップ
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class);  // Categoryは複数のContactを持つ
    }
}
