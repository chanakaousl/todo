<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'due_date',
        'due_time',
        'status',
        'todo_id'
    ];

    // Task belongs to Todo
    public function todo()
    {
        return $this->belongsTo(Todo::class);
    }

    // Check whether task is overdue or not
    public function getOverdueDateAttribute()
    {
        $dueDate = $this->attributes['due_date']. ' '. $this->attributes['due_time'];
        $today = now();

        if ($dueDate < $today) {
            return $today; // Return the date if it's already overdue
        }

        return null; // Return null if the due date is not yet overdue
    }

    // Formated the due date ex: May 16, 2023
    public function getDueDateFormatAttribute()
    {
        return Carbon::parse($this->attributes['due_date'])->format('M d, Y');
    }

    // Formated the due time ex: 7:30 AM
    public function getDueTimeFormatAttribute()
    {
        return Carbon::parse($this->attributes['due_time'])->format('g:i A');
    }
}