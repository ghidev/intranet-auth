<?php

namespace Ghidev\Core\Models;

use Ghi\Core\Presenters\UserPresenter;
use Ghi\Core\App\Auth\AuthenticatableIntranetUser;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use AuthenticatableIntranetUser, CanResetPassword, PresentableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'usuario';

    /**
     * @var string
     */
    protected $primaryKey = 'idusuario';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['usuario', 'nombre', 'correo', 'clave'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['clave', 'remember_token'];

    /**
     * Consider updated_at and created_at timestamps.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Presentador de usuario
     *
     * @var
     */
    protected $presenter = UserPresenter::class;

    /**
     * Usuario cadeco relacionado con este usuario de intranet
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function usuarioCadeco()
    {
        return $this->hasOne(UsuarioCadeco::class, 'usuario', 'usuario');
    }

    /**
     * Hashea la clave al ser establecida
     * 
     * @param string $value
     */
    public function setClaveAttribute($value)
    {
        $this->attributes['clave'] = md5($value);
    }

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        // TODO: Implement getAuthIdentifierName() method.
    }
}
