<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppPayment extends Model
{
    protected $table = 'apps_payments';
    
    protected $fillable = [
        'title', 'description', 'image', 'price', 'active', 'link', 'config'
    ];
}
