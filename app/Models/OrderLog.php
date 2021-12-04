<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderLog extends Model
{
    use HasFactory;

    protected $table = 'order_log';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'employee_id',
        'order_id',
        'status'
    ];

    public function employee(){
        return $this->hasOne(User::class, 'id', 'employee_id');
    }
}
