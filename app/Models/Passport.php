<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Passport
 *
 * @property int $id
 * @property int $member_id
 * @property string $first_name
 * @property string $last_name
 * @property int $serial
 * @property int $number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Passport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Passport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Passport query()
 * @method static \Illuminate\Database\Eloquent\Builder|Passport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Passport whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Passport whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Passport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Passport whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Passport whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Passport whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Passport whereSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Passport whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $address
 * @method static \Illuminate\Database\Eloquent\Builder|Passport whereAddress($value)
 */
class Passport extends Model
{

}
