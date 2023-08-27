<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Lophoc
 * 
 * @property string $id
 * @property string|null $tenlop
 * @property int|null $siso
 * @property int|null $khoahoc
 * 
 * @property Collection|MonhocLop[] $monhoc_lops
 *
 * @package App\Models
 */
class Lophoc extends Model
{
	protected $table = 'lophoc';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'siso' => 'int',
		'khoahoc' => 'int'
	];

	protected $fillable = [
		'id',
		'tenlop',
		'siso',
		'khoahoc'
	];

	public function monhoc_lops()
	{
		return $this->hasMany(MonhocLop::class, 'malop');
	}
}
