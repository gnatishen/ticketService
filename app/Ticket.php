<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
	public function setFilesAttribute($files)
	{
	    if (is_array($files)) {
	        $this->attributes['files'] = json_encode($files);
	    }
	}

	public function getFilesAttribute($files)
	{
	    return json_decode($files, true);
	}
}
