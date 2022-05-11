<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar novo funcionário') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <div class="box-root padding-top--24 flex-flex flex-direction--column" style="flex-grow: 1; z-index: 9;">
                        <div class="formbg">
                            <div class="formbg-inner padding-horizontal--48">
                                <form name="employee-post-form" id="employee-post-form" method="POST" action="{{ route('employeeSave') }}">
                                @include('alerts.errors')
                                @csrf
                                    <input type="hidden" name="id" value="{{ isset($employee->id) ? $employee->id : 0 }}">

                                    <div class="field padding-bottom--24">
                                        <label for="name">Nome*</label>
                                        <input type="text" name="name" required value="{{ isset($employee->name) ? $employee->name : old('name') }}">
                                    </div>
                                    
                                    <div class="field padding-bottom--24">
                                        <label for="lastname">Sobrenome*</label>
                                        <input type="text" name="last_name" required value="{{ isset($employee->last_name) ? $employee->last_name : old('last_name') }}">
                                    </div>

                                    <div class="field padding-bottom--24">
                                        <label for="id_company">Empresa*</label>
                                        <select class="field" id="id_company" name="id_company">
                                            @foreach($companies as $company)
                                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="field padding-bottom--24">
                                        <label for="email">E-mail*</label>
                                        <input type="email" name="email" required value="{{ isset($employee->email) ? $employee->email : old('email') }}">
                                    </div>

                                    <div class="field padding-bottom--24">
                                        <label for="email">Telefone*</label>
                                        <input type="tel" id="telephone" name="telephone" required data-mask="(99) 99999-9999"  placeholder="(xx) xxxxx-xxxx" value="{{ isset($employee->telephone) ? $employee->telephone : old('telephone') }}">
                                    </div>
                                    
                                    <div class="field padding-bottom--24">
                                        <input type="submit" name="submit" value="Salvar">
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

