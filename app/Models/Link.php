<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Link
 * 
 * @property int $id
 * @property string $link
 * @property bool $is_used
 * @property bool $status
 * @property string|null $salary
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Link extends Model
{
	protected $table = 'links';

	protected $casts = [
		'is_used' => 'bool',
		'status' => 'bool'
	];

	protected $fillable = [
		'link',
		'is_used',
		'status',
		'salary'
	];
}
