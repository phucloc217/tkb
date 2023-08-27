<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MonhocNgayhoc
 * 
 * @property int $id
 * @property Carbon|null $ngayhoc
 * @property int|null $id_monhoc
 * @property int|null $maphong
 * 
 * @property Phonghoc|null $phonghoc
 * @property MonhocLop|null $monhoc_lop
 *
 * @package App\Models
 */
class MonhocNgayhoc extends Model
{
	protected $table = 'monhoc_ngayhoc';
	public $timestamps = false;

	protected $casts = [
		'ngayhoc' => 'datetime',
		'id_monhoc' => 'int',
		'maphong' => 'int'
	];

	protected $fillable = [
		'ngayhoc',
		'id_monhoc',
		'maphong'
	];

	public function phonghoc()
	{
		return $this->belongsTo(Phonghoc::class, 'maphong');
	}

	public function monhoc_lop()
	{
		return $this->belongsTo(MonhocLop::class, 'id_monhoc');
	}
}
