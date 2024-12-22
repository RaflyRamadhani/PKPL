<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseHistory extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'payment_method']; // Menentukan kolom yang bisa diisi

    // Definisikan relasi ke model Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

