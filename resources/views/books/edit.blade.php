<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Book') }} 
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200">
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4 bg-red-200 text-black rounded p-2" :errors="$errors" />
                {{Form::model($book, ['route' => ['books.update', $book->id]], ['class' => 'w-full'])}}
                @method('PUT')
                <div class="flex flex-wrap -mx-3 mb-6">
                  <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    {{ Form::label('title', 'Titulo', ['class' => "block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"]) }}
                    {{ Form::text('title', null, ['class' => 'appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white']) }}
                  </div>
                  <div class="w-full md:w-1/2 px-3">
                    {{ Form::label('writer', 'Autor', ['class' => "block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"]) }}
                    {{ Form::text('writer', $book->writer->name, ['class' => 'appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white']) }}
                  </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                  <div class="w-full px-3">
                    {{ Form::label('description', 'Descrição', ['class' => "block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"]) }}
                    {{ Form::textarea('description', null, ['class' => 'appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white']) }}
                  </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                  <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                    {{ Form::label('pages', 'N° de Páginas', ['class' => "block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"]) }}
                    {{ Form::number('pages', null, ['class' => 'appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white']) }}
                  </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-2 justify-end ">
                  <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0 justify-end">
                    {{Form::submit('Salvar', ['class' => " w-full bg-green-200 hover:bg-green-400 border rounded p-2"])}}
                  </div>
                </div>
                {{Form::close()}}
              </div>
            </div>
        </div>
    </div>
</x-app-layout>