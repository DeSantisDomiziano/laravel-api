@extends('layouts.admin')

@section('content')

<div class="container">
    <h1>Types</h1>

    <div class="px-5">
        @if(session('message'))
        <div class="alert alert-success p-4">
            <strong class="fs-4">
                {{ session('message') }}
            </strong>
        </div>
        @endif
    </div>

    <div class="row row-cols-2 pt-5">
        <div class="col">

        <form action="{{ route('admin.types.store') }}" method="post">
            @csrf
            <div class="input-group mb-3 pt-5">
              <input type="text" name="type" id="type" class="form-control" placeholder="add type" aria-describedby="helpId">
              <button class="btn btn-outline-warning" type="submit">
                + add
              </button> 
            </div>
        </form>

        </div>
        <div class="col">
            <div class="table-responsive">
                <table class="table table-striped
                table-hover
                table-borderless
                table-primary
                align-middle">
                    <thead class="table-light">
            
                        <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>project</th>
                            <th>Actions</th>
            
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
            
            
                        @forelse ($types as $type)
                        <tr class="table-primary">
                            <td scope="row">{{$type->id}}</td>
                            <td>{{$type->name}}</td>
                            <td>
                                <span class="badge bg-dark">
                                    {{ $type->projects()?->count() }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.types.show', $type->id ) }}">
                                    VIEW 
                                </a>
            
                                | EDIT 

                                <!-- Modal trigger button -->
                        <button type="button" class="btn p-0 me-2 fs-4 text-danger " data-bs-toggle="modal" data-bs-target="#id-{{ $type->id }}">
                        <i class="fa-solid fa-skull"></i>
                        </button>
                        
                        <!-- Modal Body -->
                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                        <div class="modal fade" id="id-{{ $type->id }}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalTitle-{{ $type->id }}">Cancel <br> {{ $type->name }} </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <span>Do you really want it? 😭</span>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn" data-bs-dismiss="modal">
                                            <i class="fa-solid fa-xl fa-xmark text-success"></i>
                                        </button>
                                        <form action="{{ route('admin.types.destroy', $type->id) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            
                                            <button type="submit" class="btn">
                                                <i class="fa-solid fa-xl fa-trash text-danger" title="delete"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                            </td>
            
                        </tr>
                        @empty
                        <tr class="table-primary">
                            <td scope="row">No types 😅</td>
            
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
            
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    
</div>

@endsection
