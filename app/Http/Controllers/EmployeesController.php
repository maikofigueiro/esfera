<?php

namespace App\Http\Controllers;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Employee;
use App\Models\Companie;

class EmployeesController extends Controller
{
    /**
     * Lista funcionarios
     * @access public
     * @param  Request $request
     * @return string HTML
     */
    public function list(Request $request) 
    {
        /*
         * Busca todos os funcionarios e empresa
         */
        $employees = Employee::all();

        return view('employees', ['employees' => $employees]);
    }

    /**
     * Exibição dos dados do funcionario na edicao
     * @access public
     * @param  Request $request
     * @param  int     $id
     * @return string HTML
     */
    public function edit(Request $request, $id = null)
    {
        $employee = null;
        
        if($id){
            $employee = Employee::findById($id);
        }
        $companies = Companie::all();

        return view('newEmployee', ['employee' => $employee, 'companies' => $companies]);
    }

    /**
     * Action para criacao e edicao de funcionario
     * @access public
     * @param  Request $request
     * @return string HTML
     */
    public function save(Request $request)
    {
        try {

            //Validando inputs
            $validate = [
                'name'          => 'required',
                'last_name'     => 'required',
                'id_company'    => 'required',
                'email'         => 'required',
                'telephone'     => 'required'
            ];

            $validator = Validator::make($request->all(), $validate);
            if ($validator->fails()) {
                return back()->with('warning','Todos os campos precisam ser preenchidos');
            }

            // se ha input id, indica edicao do form
            if ($request->input('id')) {
                $employee = Employee::findOrFail($request->input('id'));
            } else {
                $employee = new Employee();
            }

            // preparando os dados para salvar
            $employee->name         = $request->input('name');
            $employee->last_name    = $request->input('last_name');
            $employee->id_company   = $request->input('id_company');
            $employee->email        = $request->input('email');
            $employee->telephone    = $request->input('telephone');
            // salve na tabela employees
            $employee->save();


            return redirect()->route('employees')->with('info','As informações do funcionário foram salvas.');
        } catch (\Exception $e) {
            return redirect()->route('employeeCreat')->with('error', 'Falha ao salvar dados. ' . $e->getMessage());
        }
    }

    /**
     * Action para deletar um funcionario (exclusao logica)
     * @access public
     * @param  Request $request
     * @param  int     $id
     * @return string HTML
     */
    public function delete(Request $request, $id) 
    {
        $employee = Employee::findById($id);

        try {
            $employee->delete();
            return redirect()->route('employees')->with('info','Funcionário deletado da lista.');
        } catch (\Exception $e) {
            return redirect()->route('employees')->with('error', 'Falha ao remover registro. ' . $e->getMessage());
        }

        return redirect('employees');
    }
}
