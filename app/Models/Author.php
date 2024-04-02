<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Stellen Sie sicher, dass der richtige Namespace für die User-Klasse verwendet wird

class Author extends Model
{
    protected $fillable = ['author','title','description'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
