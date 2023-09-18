<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MonhocLop
 * 
 * @property int $id
 * @property string $tenmh
 * @property int|null $sotiet
 * @property int|null $conlai
 * @property string|null $malop
 * @property string $idgv
 * 
 * @property Lophoc|null $lophoc
 * @property User $user
 * @property Collection|MonhocNgayhoc[] $monhoc_ngayhocs
 *
 * @package App\Models
 */
class MonhocLop extends Model
{
	protected $table = 'monhoc_lop';
	public $timestamps = false;

	protected $casts = [
		'sotiet' => 'int'
	];

	protected $fillable = [
		'tenmh',
		'sotiet',
		'conlai',
		'malop',
		'idgv'
	];

	public function lophoc()
	{
		return $this->belongsTo(Lophoc::class, 'malop');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'idgv');
	}

	public function monhoc_ngayhocs()
	{
		return $this->hasMany(MonhocNgayhoc::class, 'id_monhoc');
	}
}
