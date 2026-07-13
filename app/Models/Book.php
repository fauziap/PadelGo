<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;


    protected $table = 'books';
    protected $guarded = [];

    protected $with = ['user', 'court', 'schedule'];

    public function payment()
    {
        return $this->hasOne(Payment::class, 'book_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function court()
    {
        return $this->belongsTo(Court::class, 'court_id');
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }

    public function scopeSearch(Builder $query, array $filters)
    {
        $query->when($filters['keyword'] ?? false, function ($query, $keyword) {
            $query->where(function ($query) use ($keyword) {
                $query->whereHas('court', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
                })
                    ->orWhereHas('user', function ($q) use ($keyword) {
                        $q->where('first_name', 'like', '%' . $keyword . '%')
                            ->orWhere('email', 'like', '%' . $keyword . '%');
                    });
            });
        });

        $query->when($filters['status'] ?? false, function ($query, $status) {
            $query->where(function ($query) use ($status) {
              $query->where('payment_status', $status);
            });
        });
    }
}
