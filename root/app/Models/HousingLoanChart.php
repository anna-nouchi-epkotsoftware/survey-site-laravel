<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HousingLoanChart extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * 複数代入可能な属性
     *
     * @var array
     */
    protected $fillable = [
        'usage_situation',
        'name',
        'financial_institution',
        'financial_institution2',
        'financial_institution3',
        'financial_institution4',
        'deleted_at',
        'created_at',
        'updated_at',
    ];
}
