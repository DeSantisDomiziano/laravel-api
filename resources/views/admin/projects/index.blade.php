@extends('layouts.admin')

@section('content')

<div class="container">
    <h1>Projects</h1>

    <div class="px-5">
        @if(session('message'))
        <div class="alert alert-success p-4">
            <strong class="fs-4">
                {{ session('message') }}
            </strong>
        </div>
        @endif
    </div>

    <a href="{{ route('admin.projects.create') }}" class="btn btn-warning fw-bold my-2">+ Add Project</a>

    <div class="table-responsive">
        <table class="table table-striped
        table-hover
        table-borderless
        table-primary
        align-middle">
            <thead class="table-light">

                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>type</th>
                    <th>technologies</th>
                    <th>Actions</th>

                </tr>
            </thead>
            <tbody class="table-group-divider">


                @forelse ($projects as $project)
                <tr class="table-primary">
                    <td scope="row">{{$project->id}}</td>
                    <td><img height="100" src="{{ asset('storage/' . $project->img_path) }}" alt="{{$project->title}}"></td>
                    <td>{{$project->title}}</td>
                    <td>{{$project->slug}}</td>
                    <td>
                        <span class="badge bg-dark">{{ $project->type?->name}}</span>
                    </td>
                    <td>
                        @foreach($project->technologies as $technology)
                            <span class="badge bg-dark">{{ $technology->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('admin.projects.show', $project->slug ) }}">
                            VIEW |
                        </a>

                        <a href="{{ route('admin.projects.edit', $project->slug ) }}">
                            EDIT |
                        </a>

                        <!-- Modal trigger button -->
                        <button type="button" class="btn p-0 me-2 fs-4 text-danger " data-bs-toggle="modal" data-bs-target="#id-{{ $project->id }}">
                            <i class="fa-solid fa-skull"></i>
                        </button>

                        <!-- Modal Body -->
                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                        <div class="modal fade" id="id-{{ $project->id }}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalTitle-{{ $project->id }}">Cancel <br> {{ $project->name }} </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <span>Do you really want it? 😭</span>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn" data-bs-dismiss="modal">
                                            <i class="fa-solid fa-xl fa-xmark text-success"></i>
                                        </button>
                                        <form action="{{ route('admin.projects.destroy', $project->slug) }}" method="post" class="d-inline">
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
                    <td scope="row">No projects 😅</td>

                </tr>
                @endforelse
            </tbody>
            <tfoot>

            </tfoot>
        </table>
    </div>
</div>

@endsection