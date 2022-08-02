<?php

namespace App\Models;

use App\Models\Question;
use App\Events\CommentSend;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    protected $dispatchesEvents = [
        'created' => CommentSend::class
    ];
    protected $fillable = [
        'user_id',
        'content',
    ];
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
