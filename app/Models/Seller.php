<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;
    public function sellerImage()
    {
        // folder inside the public path for default image
        $imagePath = ($this->image) ? $this->image : 'jAZHCrXvUSsoh3BtdypreKvz8tz0M4DEnDOfvvDt.png';
        return 'public/' . $imagePath;
    }

    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function service()
    {
        return $this->hasMany(Service::class);
    }
    public function followers()
    {
        return $this->belongsToMany(User::class);
    }
}
