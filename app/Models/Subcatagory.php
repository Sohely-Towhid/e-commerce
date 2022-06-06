<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Catagory;
class Subcatagory extends Model
{
    use HasFactory;

  public  function rel_to_catagory(){
      return  $this->belongsTo(Catagory::class,'catagory_id','id')->withTrashed();
    }
}
