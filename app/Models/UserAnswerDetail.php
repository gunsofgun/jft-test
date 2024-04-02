<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswerDetail extends Model
{
    use HasFactory;

    protected $table = 'user_answer_details';
    protected $fillable = ['answer_char', 'question_test_id', 'section_id', 'user_answer_id'];
}
