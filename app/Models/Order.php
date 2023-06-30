<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['customer_id', 'fullname', 'email', 'phone', 'address', 'payment_method', 'order_detail', 'status', 'totalCart', 'code', 'note', 'code_product'];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function getOrderDetails()
    {
        return json_decode($this->order_detail, true);
    }
    

    public function getTotalSoldQuantity()
    {
        $orderDetails = $this->getOrderDetails();
        $totalSoldQuantity = 0;
        
        if ($orderDetails) {
            foreach ($orderDetails as $orderDetail) {
                $totalSoldQuantity += $orderDetail['qty'];
            }
        }
        
        return $totalSoldQuantity;
    }
}
