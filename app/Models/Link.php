<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Link extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'original_link','token', 'views', 'max_views', 'expired_at', 'user_id'];

    protected $status = 'active';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function calculateStatus()
    {
        if ($this->expired_at && Carbon::now('GMT+2')->gt($this->expired_at)) {
            return 'expired';
        } else {
            if ($this->max_views == 0) {
                return 'active';
            } elseif ($this->views < $this->max_views) {
                return 'active';
            }
            return 'expired';
        }
    }
    public function incrementViews()
    {
        $this->increment('views');

        return $this;
    }
}

