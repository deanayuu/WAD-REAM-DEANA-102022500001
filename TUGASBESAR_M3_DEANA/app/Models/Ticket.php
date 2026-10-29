<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';
    protected $fillable = ['nama_pembeli', 'tipe_tiket', 'harga', 'kuota', 'benefit'];
}