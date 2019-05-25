<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    protected $fillable = ['title', 'publisher', 'destination', 'start_date', 'end_date', 'comments_number', 'comments_content', 'tags']; 
}
