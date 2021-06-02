<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Trails\ModelScopes;

class Branchs extends Model
{

	use ModelScopes;
	
    protected $table = 'branchs';
    
    protected $guarded = [];
}
