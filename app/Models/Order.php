<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    Use HasFactory;

    protected $table = "orders";

    protected $fillable =[
        "user_id",
        "address_id",
        "order_number",
        "order_notes",
        "payment_method",
        "status",
        "first_name",
        "last_name",
        "address_line_1",
        "address_line_2",
        "city",
        "state",
        "postal_code",
        "country",
        "order_address_default",
        "total",
        "products",
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function address(){
        return $this->belongsTo(Address::class, 'address_id');
    }

   protected $casts = [
    'products' => 'array',
   ];

}
