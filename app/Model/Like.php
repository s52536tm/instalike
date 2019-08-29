<?php
namespace App\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Like extends Authenticatable
{
    use Notifiable;
    protected $fillable = ['posts_id', 'users_id', 'created_at', 'updated_at'];
}