<?php
namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Cms extends Model{
    use Notifiable,SoftDeletes;
    protected $table = 'cms';
    protected $fillable = ['module_name','name','meta_title','meta_keyword','meta_description','description','meta_tag'];
}