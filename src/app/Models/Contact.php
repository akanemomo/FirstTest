<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    // その他のコード...

    /**
     * ContactとCategoryのリレーションシップ
     */
    public function category()
    {
        return $this->belongsTo(Category::class);  // ContactはCategoryに所属
    }
}
