<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupType extends Model
{
  protected $table = 'group_types';
  protected $primaryKey = 'group_type_id';
  protected $fillable = ['name'];
  public $timestamps = false;

  public function parentCategories()
  {
    return $this->hasMany(ParentCategory::class, 'group_type_id', 'group_type_id');
  }
}
