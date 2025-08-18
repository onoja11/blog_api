<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Mailables\Content;
use Mews\Purifier\Casts\CleanHtml;

class Post extends Model
{
    use HasFactory;
    //
    protected $fillable = ['title', 'content','priority', 'user_id',];

    protected $casts =[
        'content' => CleanHtml::class,
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
