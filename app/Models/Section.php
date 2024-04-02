<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $table = 'sections';
    protected $fillable = ['section_name', 'section_code', 'package_test_id'];

    public function package_tests()
    {
        return $this->belongsTo(PackageTest::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
