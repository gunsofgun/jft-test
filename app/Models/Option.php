<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    protected $table = 'options';
    protected $fillable = ['opt_content', 'opt_char', 'opt_img', 'group_option_id'];

    public function group_options()
    {
        return $this->belongsTo(GroupOption::class);
    }
}
