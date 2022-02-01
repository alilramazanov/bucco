<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * App\Models\Member
 *
 * @property int $id
 * @property string $name
 * @property string $password
 * @property string $login
 * @property int $admin_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Admin $admin
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Group[] $groups
 * @property-read int|null $groups_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Portfolio[] $portfolio
 * @property-read int|null $portfolio_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Task[] $tasks
 * @property-read int|null $tasks_count
 * @method static \Illuminate\Database\Eloquent\Builder|Member newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Member newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Member query()
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $avatar
 * @method static \Illuminate\Database\Query\Builder|Member onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereAvatar($value)
 * @method static \Illuminate\Database\Query\Builder|Member withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Member withoutTrashed()
 * @property int|null $serial
 * @property int|null $number
 * @property string|null $address
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereSerial($value)
 * @property string $password_visible
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Penalties[] $penalties
 * @property-read int|null $penalties_count
 * @method static \Illuminate\Database\Eloquent\Builder|Member wherePasswordVisible($value)
 * @property string $user_notification_id
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereUserNotificationId($value)
 */
class Member extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authorizable;
    use Authenticatable;
    use HasFactory;
    use SoftDeletes;

    protected $table = 'members';

    public const DEFAULT_AVATAR = 'members/default.png';

    protected $fillable = [
        'name', 'login', 'password', 'admin_id',
        'avatar', 'serial', 'number', 'address', 'password_visible', 'user_notification_id', 'onesignal_app'
    ];

    protected $hidden = [
        'password'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function groups(){
        return $this->belongsToMany(Group::class, 'group_members', 'member_id', 'group_id');
    }

    public function tasks(){
        return $this->hasMany(Task::class);
    }


    public function admin(){
        return $this->belongsTo(Admin::class);
    }

    public function penalties(){
        return $this->hasMany(Penalties::class);

    }

}
