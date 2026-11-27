<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public const STATUS_MENUNGGU  = 'menunggu_pembayaran';
    public const STATUS_DIPROSES  = 'diproses';
    public const STATUS_SIAP      = 'siap';
    public const STATUS_SELESAI   = 'selesai';
    public const STATUS_DIBATALKAN = 'dibatalkan';

    protected $fillable = [
        'order_no', 'user_id', 'customer_name', 'order_type',
        'table_no', 'status', 'total', 'notes', 'ordered_at',
    ];

    protected $casts = ['ordered_at' => 'datetime'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}