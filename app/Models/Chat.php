<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Events\BroadcastChat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $dispatchesEvents = [
        'created' => BroadcastChat::class
    ];
    protected $fillable = [
        'author', 'other', 'room', 'type', 'chat', 'gate', 'code', 'messageSid'
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    public function users(){
        if($this->gate == 'pusher')
            return $this->belongsTo(User::class, 'author');
    }
    public function friends(){
        if($this->gate == 'pusher')
            return $this->belongsTo(User::class, 'other');
    }
    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('H:i A');
    }
}
