<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\TextUI\XmlConfiguration\Groups;


/**
 * App\Models\Expense
 *
 * @property int $id
 * @property string $name
 * @property string $date_of_debiting
 * @property int $payment_amount
 * @property bool $is_paid
 * @property int $group_id
 * @property int $expense_category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\ExpenseCategory $expenseCategory
 * @property-read \App\Models\Group $group
 * @method static \Illuminate\Database\Eloquent\Builder|Expense newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense query()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereDateOfDebiting($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereExpenseCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereIsPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense wherePaymentAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Expense extends Model
{
    protected $table = 'expenses';
    protected $fillable = [
        'name',
        'date_of_debiting',
        'payment_amount',
        'is_paid',
        'expense_category_id',
        'group_id'

    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d'
    ];

    public function group(){
        return $this->belongsTo(Group::class);
    }

    public function expenseCategory(){
        return $this->belongsTo(ExpenseCategory::class, );
    }




}
