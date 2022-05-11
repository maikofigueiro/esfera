<?php

namespace App\Http\Controllers;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Companie;

class CompaniesController extends Controller
{
    /**
     * Lista empresas
     * @access public
     * @param  Request $request
     * @return string HTML
     */
    public function list(Request $request) 
    {
        /*
         * Busca todas as empresas
         */
        $companies = Companie::all();

        return view('companies', ['companies' => $companies]);
    }

    /**
     * Exibição dos dados da empresa na edicao
     * @access public
     * @param  Request $request
     * @param  int     $id
     * @return string HTML
     */
    public function edit(Request $request, $id) 
    {
        $company = Companie::findById($id);

        return view('newCompany', ['company' => $company]);
    }

    /**
     * Action para criacao e edicao de empresa
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
                'email'         => 'required',
                'site'          => 'required'
            ];
            $validator = Validator::make($request->all(), $validate);
            if ($validator->fails()) {
                return back()->with('warning','Todos os campos precisam ser preenchidos');
            }

            // se ha input id, indica edicao do form
            if ($request->input('id')) {
                $companie = Companie::findOrFail($request->input('id'));
            } else {
                $companie = new Companie();
            }

            // validando se o arquivo existe e se e valido
            if ($request->hasFile('logo_companie') && $request->file('logo_companie')->isValid()) {
                $name = $request->file('logo_companie')->getClientOriginalName();

                // faz o upload da imagem no projeto
                $upload = $request->file('logo_companie')->storeAs('public/companie', $name);
                
                // recuperando imagem para validar tamanho enviado
                $img = storage_path('app/public/companie/'.$name);
                list($widthImg, $heightImg) = getimagesize($img);
                if($widthImg < 100 || $heightImg < 100){
                    // deletando a imagem inválida
                    unlink($img);
                    return back()->with('warning','A imagem precisa ter o mínimo de 100px x 100px.');
                }

                if ( !$upload ){
                    return redirect()->route('companyCreat')->with('error','Falha ao fazer upload da imagem. Selecione outra imagem.');
                }

                // preparando os dados para salvar
                $companie->logo     = 'companie/'.$name;
            }

            $companie->name     = $request->input('name');
            $companie->email    = $request->input('email');
            $companie->site     = $request->input('site');
            // salve na tabela companies
            $companie->save();


            return redirect()->route('companies')->with('info','As informações da empresa foram salvas.');
        } catch (\Exception $e) {
            return redirect()->route('companyCreat')->with('error', 'Falha ao salvar dados. ' . $e->getMessage());
        }
    }

    /**
     * Action para deletar uma empresa (exclusao logica)
     * @access public
     * @param  Request $request
     * @param  int     $id
     * @return string HTML
     */
    public function delete(Request $request, $id) 
    {
        $company = Companie::findById($id);

        try {
            $company->delete();
            return redirect()->route('companies')->with('info','Empresa deletada da lista.');
        } catch (\Exception $e) {
            return redirect()->route('companies')->with('error', 'Falha ao remover registro. ' . $e->getMessage());
        }

        return redirect('companies');
    }
}
