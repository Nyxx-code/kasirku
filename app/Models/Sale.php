<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Sale extends Model
{
    use HasFactory, SoftDeletes; 

    protected $fillable = [
        'user_id', 
        'total',
    ];

    public function saleItems(): HasMany
    {
        return $this->hasMany(SaleItem::class);
    }
    
    // Relasi balik ke tabel User/Kasir
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}