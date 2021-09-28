<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-end mb-2">
                  <a href="{{ route('books.create') }}" id="create" class="bg-green-200 hover:bg-green-400 border rounded p-2">Cadastrar</a>
                </div>
                <table class="table-auto border " id="table">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Titulo</th>
                      <th>Descrição</th>
                      <th>Autor</th>
                      <th>Paginas</th>
                      <th>Criado Em</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    
                  </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>

</x-app-layout>

<script>
  $(document).ready(function() {
    table = $('#table').DataTable({
        serverSide: true,
        ajax: {
            url: "books/table_data",
            type: "GET",
        },
        columns: [
            {"data": "id",},
            {"data": "title",},
            {"data": "description"},
            {"data": "writer", orderable: false,},
            {"data": "pages"},
            {"data": "created_at"},
            {"data": 'buttons', orderable: false,}
        ],
        order: [[0, 'desc']],
        "language": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sProcessing": "A processar...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "Não foram encontrados resultados",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando de 0 até 0 de 0 registros",
            "sInfoFiltered": "(filtrado de _MAX_ registros no total)",
            "sInfoPostFix": "",
            "sSearch": "Procurar:",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "Primeiro",
                "sPrevious": "Anterior",
                "sNext": "Seguinte",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        }
    });


  });
</script>
