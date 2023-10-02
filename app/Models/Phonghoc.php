<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Phonghoc
 * 
 * @property int $id
 * @property string $tenphong
 * 
 * @property Collection|MonhocNgayhoc[] $monhoc_ngayhocs
 *
 * @package App\Models
 */
class Phonghoc extends Model
{
	protected $table = 'phonghoc';
	public $timestamps = false;

	protected $fillable = [
		'tenphong',
		'succhua'
	];

	public function monhoc_ngayhocs()
	{
		return $this->hasMany(MonhocNgayhoc::class, 'maphong');
	}
}
