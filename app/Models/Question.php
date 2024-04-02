<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $table = 'questions';
    protected $fillable = [
        'que_num', 'que_content', 'que_content_eng', 
        'que_content_ind', 'que_audio', 'que_img', 
        'section_id', 'que_score'];

    public function sections()
    {
        return $this->belongsTo(Section::class);
    }

    public function group_options()
    {
        return $this->hasMany(GroupOption::class);
    }
}
