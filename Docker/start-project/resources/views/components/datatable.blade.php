<div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8 text-center">
            <span class="fs-4 text-secondary"><b>{{ mb_strtoupper($title, 'UTF-8') }}</b></span>
        </div>
        <div class="col-2 text-center">
            @if($create != "")
                @if($id == "")
                    <a href= "{{ route($create) }}" class="btn btn-primary">
                @else
                    <a href= "{{ route($create, $id) }}" class="btn btn-primary">
                @endif
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                    </svg>
                </a>
            @endif
        </div>
    </div>
    <table class="table align-middle caption-top table-striped">
        <thead>
            <tr>
                @php $cont=0; @endphp
                @foreach ($header as $item)
                    @if($hide[$cont])
                        <th scope="col" class="d-none d-md-table-cell">{{ mb_strtoupper($item, 'UTF-8') }}</th>
                    @else
                        <th scope="col">{{ mb_strtoupper($item, 'UTF-8') }}</th>
                    @endif
                    @php $cont++; @endphp
                @endforeach
            </tr>
        </thead>
        <tbody>
            @if(!is_array($dados)) 
                @php $dados=$dados->toArray(); @endphp
            @endif
            @foreach ($dados as $item)
                <tr>
                    @php $cont=0; @endphp
                    @foreach ($fields as $f)
                        @if($hide[$cont])
                            <td class="d-none d-md-table-cell">
                                {{ $item[$fields[$cont]] }}
                            </td>
                        @else
                            <td>{{ $item[$fields[$cont]] }}</td>
                        @endif
                        @php $cont++; @endphp    
                    @endforeach
                    <td>
                        <a href="{{ route($crud.'.edit', $item['id']) }}" class="btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z"/>
                                <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z"/>
                            </svg>
                        </a>
                        <a href="{{ route($crud.'.show', $item['id']) }}" class="btn btn-info">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                            </svg>
                        </a>
                        <a nohref style="cursor:pointer" onclick="showRemoveModal('{{ $item['id'] }}', '{{ $item[$remove] }}', '{{ $modal }}')" class="btn btn-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                            </svg>
                        </a>
                    </td>
                    <form action="{{ route($crud.'.destroy', $item['id']) }}" method="POST" id="form_{{$item['id']}}">
                        @csrf
                        @method('DELETE')
                    </form>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal de Remoção -->
    <div class="modal fade" tabindex="-1" id="removeModal_{{$modal}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-danger">Operação de Remoção</h5>
              <button type="button" class="btn-close" data-bs-dismiss="removeModal" onclick="closeRemoveModal('{{$modal}}')" aria-label="Close"></button>
            </div>
            <input type="hidden" id="id_remove">
            <div class="modal-body text-secondary">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-block align-content-center" onclick="closeRemoveModal('{{$modal}}')">
                    Não
                </button>
              <button type="button" class="btn btn-danger" onclick="remove('{{$modal}}')">
                    Sim
              </button>
            </div>
          </div>
        </div>
    </div>

    <script type="text/javascript">

        // FUNÇÕES - MODAL DE REMOÇÃO //
        function showRemoveModal(id, nome, modal) {
            let modal_name = '#removeModal_' + modal;
            $('#id_remove').val(id);
            $(modal_name).modal().find('.modal-body').html("");
            $(modal_name).modal().find('.modal-body').append("Deseja remover o registro <b class='text-danger'>'"+nome+"'</b> ?");
            $(modal_name).modal('show');
        }
        
        function closeRemoveModal(modal) {
            let modal_name = '#removeModal_' + modal;
            $(modal_name).modal('hide');
        }

        function remove(modal) {
            let modal_name = '#removeModal_' + modal;
            let id = $('#id_remove').val();
            let form = "form_" + $('#id_remove').val();
            document.getElementById(form).submit();
            $(modal_name).modal('hide')
        }
    </script>
</div>

