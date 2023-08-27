<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * 
 * @property string $id
 * @property string $name
 * @property Carbon|null $ngaysinh
 * @property string|null $hocham
 * @property string|null $hocvi
 * @property string|null $sdt
 * @property string|null $diachi
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|MonhocLop[] $monhoc_lops
 *
 * @package App\Models
 */
class User extends Model
{
	protected $table = 'users';
	public $incrementing = false;

	protected $casts = [
		'ngaysinh' => 'datetime',
		'email_verified_at' => 'datetime'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'id',
		'name',
		'ngaysinh',
		'hocham',
		'hocvi',
		'sdt',
		'diachi',
		'email',
		'email_verified_at',
		'password',
		'remember_token'
	];

	public function monhoc_lops()
	{
		return $this->hasMany(MonhocLop::class, 'idgv');
	}
}
