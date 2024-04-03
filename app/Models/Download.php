<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    protected $fillable = [
        'book_id', 'user_id'
    ];

    // Definieren Sie die Beziehung zwischen Downloads und Büchern
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}