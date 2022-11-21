<?php

namespace Task\Models\Picture;

use Task\Models\BaseModel;

class Picture extends BaseModel
{
    // Model name
    protected $table = 'picture';

    protected $fillable = ['name', 'description', 'filename'];

    protected $guarded = ['id'];

    public $timestamps = false;

}