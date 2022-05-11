<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use SoftDeletes;

    /**
     * Propriedades que podem ser definidas via mass-assign
     * @var array
     */
    protected $fillable = [
        'name',
        'last_name',
        'id_company',
        'email',
        'telephone'
    ];

    /**
     * Regras de validação
     *
     * @access public 
     * @return array
     */
    public function rules() : array
    {
        return [
            'name'          => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'id_company'    => 'required|exists:client,id',
            'email'         => 'required|string|max:255',
            'telephone'     => 'required',
        ];
    }


    /**
     * Consulta o registro do funcionario pelo $id
     *
     * @static
     * @access public
     * @param  int $id
     * @return Employee
     */
    public static function findById(int $id) : Employee
    {
        return self::where('id', $id)->first();
    }


    /**
     * Relation belongs-to: Companie
     *
     * @access public
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Companie::class, 'id_company');
    }
}
