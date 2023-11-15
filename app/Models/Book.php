<?php 
namespace App\Models;

use CodeIgniter\Model;

class Book extends Model{
    protected $table      = 'books';
    protected $primaryKey = 'id';
    protected $allowedFields=['name','image'];
}