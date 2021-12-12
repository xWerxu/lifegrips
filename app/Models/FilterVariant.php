<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilterVariant extends Model
{
    use HasFactory;

    protected $table = 'filter_variant';

    public function variant(){
        return $this->belongsTo(Variant::class, 'variant_id');
    }
}
