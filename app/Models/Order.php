<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['status'];

    public function order_details()
    {
        return $this->hasMany('App\Models\OrderDetail', 'order_id', 'id');
    }

    public function order_invoice()
    {
        return $this->hasOne('App\Models\OrderInvoice', 'order_id');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order', 'user_id', 'user_id');
    }


    public function users()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function order_tracks()
    {
        return $this->hasOne('App\Models\OrderTrack', 'order_id');
    }

    public function customer()
    {
        return $this->hasOne('App\Models\User', 'id', 'buyer_id');
    }

    public function udc_customer()
    {
        return $this->hasOne('App\models\UdcCustomer', 'id', 'customer_id');
    }

    public function UdcCustomer()
    {
        return $this->belongsTo('App\models\UdcCustomer', 'customer_id');
    }

    public function ep_info()
    {
        return $this->hasOne('App\models\EcommercePartner', 'id', 'ep_id');
    }

    public function lp_info()
    {
        return $this->hasOne('App\models\LogisticPartner', 'id', 'lp_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function order_track(){
        return $this->hasMany(OrderTrack::class, 'order_id', 'id');
    }
}
