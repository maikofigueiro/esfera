<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Empresas') }}
        </h2>
    </x-slot>

        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <a href="{{ route('companyCreat') }}" class="button mb-4">Cadastrar nova empresa</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Empresa</th>
                                    <th>Contato</th>
                                    <th>Site</th>
                                    <th>Logo da empresa</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($companies as $company)
                                <tr>
                                    <td>{{ $company->name }}</td>
                                    <td>{{ $company->email }}</td>
                                    <td>{{ $company->site }}</td>
                                    <td>
                                        <img id="logo_companie" src="{{Storage::url($company->logo)}}" width="100"/>
                                    </td>
                                    <td>
                                        <div>
                                            <a href="{{ route('companyEdit', $company->id) }}" class="button-edit mb-1">Editar</a>
                                        </div>
                                        <div>
                                            <a href="{{ route('companyDelete', $company->id) }}" class="button-delete mb-1">Deletar</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    

</x-app-layout>
