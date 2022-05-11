<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar nova empresa') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="box-root padding-top--24 flex-flex flex-direction--column" style="flex-grow: 1; z-index: 9;">
                        <div class="formbg">
                            <div class="formbg-inner padding-horizontal--48">
                                <form method="POST" enctype="multipart/form-data" action="{{ route('companySave') }}">
                                @include('alerts.errors')
                                @csrf
                                    <input type="hidden" name="id" value="{{ isset($company->id) ? $company->id : 0 }}">

                                    <div class="field padding-bottom--24">
                                        <label for="name-companie">Nome da empresa*</label>
                                        <input type="text" required name="name" value="{{ isset($company->name) ? $company->name : old('name') }}">
                                    </div>
                                    
                                    <div class="field padding-bottom--24">
                                        <label for="email">Email*</label>
                                        <input type="email" required name="email" value="{{ isset($company->email) ? $company->email : old('email') }}">
                                    </div>

                                    <div class="field padding-bottom--24">
                                        <label for="site">Site da empresa*</label>
                                        <input type="text" required name="site" value="{{ isset($company->site) ? $company->site : old('site') }}">
                                    </div>

                                    <div class="field padding-bottom--24">
                                        <label for="img-companie">Logo da empresa</label>
                                        @if(isset($company->logo))
                                            <img class="mb-3" id="logo_companie" src="{{Storage::url($company->logo)}}" width="100"/>
                                        @endif
                                        <input type="file" name="logo_companie" id="logo_companie">                                        
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
