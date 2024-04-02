<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    use HasFactory;

    protected $table = 'user_answers';
    protected $fillable = ['is_done', 'user_id'];

    public function user_answer_details()
    {
        return $this->hasMany(UserAnswerDetail::class);
    }
}
