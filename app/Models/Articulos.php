<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Articulos extends Model
{
  use HasFactory;
  use SoftDeletes;
  protected $connection = "privada";
  protected $table = "erp_articulos";
}
