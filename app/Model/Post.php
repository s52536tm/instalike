<?php
namespace App\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Post extends Authenticatable
{
    use Notifiable;
    protected $fillable = ['picture', 'caption', 'github_id', 'github_name', 'created_at', 'updated_at'];
}