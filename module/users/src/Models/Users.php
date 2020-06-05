<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/31/2017
 * Time: 4:52 PM
 */

namespace Users\Models;

use http\Client\Curl\User;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class Users extends Authenticatable
{
    use EntrustUserTrait;
    protected $table = 'users';

    protected $fillable = [
        'email', 'password', 'thumbnail', 'fullname', 'passport', 'parent', 'code_name', 'affiliate', 'phone', 'status', '_left', '_right', 'gender', 'created_at', 'updated_at', 'address', 'token'
    ];

    protected $hidden = [
        'password', 'remember_token', 'google2fa_secret'
    ];

    /**
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * @param $value
     */
    public function setUsernameAttribute($value)
    {
        $this->attributes['username'] = str_slug($value, '_');
    }

    //Big block of caching functionality.
    public function cachedRoles()
    {
        $userPrimaryKey = $this->primaryKey;
        $cacheKey = 'entrust_roles_for_user_' . $this->$userPrimaryKey;
        return Cache::tags(Config::get('acl.role_user_table'))->remember($cacheKey, Config::get('cache.ttl'), function () {
            return $this->roles()->get();
        });
    }

    /**
     * @param array $options
     * @return bool
     */
    public function save(array $options = [])
    {   //both inserts and updates
        $result = parent::save($options);
        Cache::tags(Config::get('acl.role_user_table'))->flush();
        return $result;
    }

    /**
     * @param array $options
     * @return bool|null
     * @throws \Exception
     */
    public function delete(array $options = [])
    {   //soft or hard
        $result = parent::delete($options);
        Cache::tags(Config::get('acl.role_user_table'))->flush();
        return $result;
    }

    /**
     * @return mixed
     */
    public function restore()
    {   //soft delete undo's
        $result = parent::restore();
        Cache::tags(Config::get('acl.role_user_table'))->flush();
        return $result;
    }

    /**
     * Many-to-Many relations with Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Config::get('acl.role'), Config::get('acl.role_user_table'), Config::get('acl.user_foreign_key'), Config::get('acl.role_foreign_key'));
    }

    /**
     * Get role name
     * @return null
     */
    public function getRole()
    {
        $roles = $this->roles()->first();
        if (!empty($roles)) {
            return $roles->display_name;
        } else {
            return null;
        }
    }

    /**
     * Relation 1 - n with meta data
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function data()
    {
        return $this->hasMany(UsersMeta::class);
    }

    public function referral()
    {
        return $this->belongsToMany(UserRefferals::class, 'user_referrals', 'user_id', 'referral_id');
    }

}