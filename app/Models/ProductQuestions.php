<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Trails\ModelScopes;

class ProductQuestions extends Model
{
	use ModelScopes;
    protected $table = 'product_questions';
}
