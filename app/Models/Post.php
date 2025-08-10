<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';          

    public $primaryKey = 'id';            
    public $incrementing = true;          // Tự
    public $timestamps = true;            // Có cột created_at và updated_at

    protected $attributes = [
        'status' => 0                     // Mặc định status = 0
    ];
}