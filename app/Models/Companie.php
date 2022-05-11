<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Companie extends Model
{
    use SoftDeletes;

    /**
     * Propriedades que podem ser definidas via mass-assign
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'logo',
        'site'
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
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'site'      => 'required|string|max:255'
        ];
    }

    /**
     * Relation has-many: Employee
     *
     * @access public
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employees() : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Employee::class, 'id')->orderBy('name', 'asc');
    }

    /**
     * Consulta o registro da empresa pelo $id
     *
     * @static
     * @access public
     * @param  int $id
     * @return Companie
     */
    public static function findById(int $id) : Companie
    {
        return self::where('id', $id)->first();
    }
}
