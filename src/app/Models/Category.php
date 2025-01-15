<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // その他のコード...

    /**
     * CategoryとContactのリレーションシップ
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class);  // Categoryは複数のContactを持つ
    }
}
