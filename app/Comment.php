<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Plugin\Addon;
use App\Aagc;

class Comment extends Model
{
    protected $fillable = ['teacher_comment','hostel_comment','principal_comment','student_id','aagc_id','session_id','student_category_id','term_id'];
    protected $table = 'comments';


    public static function comments($aagc_id,$session_id,$term_id,$student_category_id,$student_id) {
        $condition = array(
            ['aagc_id', $aagc_id],
            ['session_id', $session_id],
            ['student_category_id', $student_category_id],
            ['student_id', $student_id],
            ['term_id', $term_id]
        );
        $result = DB::table('comments')
                ->where($condition)->first();

                return $result;
    }


}
