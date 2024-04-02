<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupOption extends Model
{
    use HasFactory;
    protected $table = 'group_options';
    protected $fillable = ['opt_title', 'opt_correct', 'question_id'];

    public function questions()
    {
        return $this->belongsTo(Question::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }
}
