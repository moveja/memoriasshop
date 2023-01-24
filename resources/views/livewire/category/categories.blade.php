<div>
<div class="row sales layout-top-spacing">

    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{$componentName}} | {{$pageTitle}}</b>
                </h4>
                <ul class="tabs tab-pills">
                   <!-- @can('Category_Create')-->
                   <li>
                        <a href="javascript:void(0)" class="tabmenu bg-dark" data-toggle="modal" 
                        data-target="#theModal">Agregar</a>
                    </li>
                   <!-- @endcan-->
                </ul>
            </div>
           <!-- @can('Category_Search')-->
            @include('common.searchbox')
           <!-- @endcan -->
            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-bordered table striped mt-1">
                        <thead class="text-white" style="background: #3B3F5C">
                            <tr>
                                <th class="table-th text-white">DESCRIPCION</th>
                                <th class="table-th text-white">IMAGEN</th>
                                <th class="table-th text-white">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>  
                        @foreach($categories as $category)
                            <tr>
                                <td><h6>{{$category->name}}</h6></td>
                                <td class="text-center">
                                    <span>
                                        <img src="{{ asset('storage/categories/' . $category->imagen) }}" 
                                        alt="imagen de ejemplo" height="70" width="80" class="rounded">
                                    </span>
                                </td>

                                <td class="text-center">
                                   
                                    <a href="javascript:void(0)" 
                                    wire:click.prevent="Edit({{$category->id}})"
                                    class="btn btn-dark mtmobile" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                   
                                    <a href="javascript:void(0)"
                                    onclick="Confirm('{{$category->id}}', '{{ $category->products->count()}}')" 
                                    class="btn btn-dark" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </a>

                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$categories->links()}}
                </div>
            </div>
        </div>
    </div>

    @include('livewire.category.form')

</div>


<script>
    document.addEventListener('DOMContentLoaded', function(){
        window.livewire.on('show-modal', msg =>{
            $('#theModal').modal('show')
        });
        window.livewire.on('category-added', msg =>{
            $('#theModal').modal('hide')
        });
        window.livewire.on('category-updated', msg =>{
            $('#theModal').modal('hide')
        });
        
    });

    function Confirm(id, products){

        if(products > 0){
            swal('NO SE PUEDE ELIMINAR LA CATEGORIA PORQUE TIENE PRODUCTOS RELACIONADOS')
            return;
        }
        swal({
            title: 'CONFIRMAR',
            text: 'CONFIRMAS ELIMINAR EL REGISTRO?',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#fff',
            confirmButtonColor: '#3B3F5C',
            confirmButtonText: 'ACEPTAR',
        }).then(function(result){
            if(result.value){
                window.livewire.emit('deleteRow', id)
                swal.close()
            }
        })

    }

</script>
</div>
