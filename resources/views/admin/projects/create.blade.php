@extends('layouts.admin')

@section('content')

<form action="{{ route('admin.projects.store') }}" method="post" class="my-5" enctype="multipart/form-data">
    @csrf

    <h1 class="mb-4">Add New Project</h1>

    <div class="mb-3">
        <label for="title" class="form-label fw-bold">Title</label>
        <input type="text" name="title" id="title" placeholder="" aria-describedby="helpId" class="form-control form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
        <small id="helpId" class="text-muted">Add Title</small>
        @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="img_path" class="form-label fw-bold">Image Path</label>
        <input type="file" name="img_path" id="img_path" placeholder="" aria-describedby="helpId" class="form-control form-control @error('img_path') is-invalid @enderror" required>
        <small id="helpId" class="text-muted">Add Image Path</small>
        @error('img_path')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="link_code" class="form-label fw-bold">Link Code</label>
        <input type="text" name="link_code" id="link_code" placeholder="" aria-describedby="helpId" class="form-control form-control @error('link_code') is-invalid @enderror" value="{{ old('link_code') }}" required>
        <small id="helpId" class="text-muted">Add Link Code</small>
        @error('link_code')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="link_website" class="form-label fw-bold">Link Website</label>
        <input type="text" name="link_website" id="link_website" placeholder="" aria-describedby="helpId" class="form-control form-control @error('link_website') is-invalid @enderror" value="{{ old('link_website') }}" required>
        <small id="helpId" class="text-muted">Add Link Website</small>
        @error('link_website')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class='form-group mb-3'>
        <p>Seleziona i type:</p>
        @foreach ($types as $type)
        <div class="form-check @error('types') is-invalid @enderror">
            <label class='form-check-label'>
                <input name='type_id' type='radio' value='{{ $type->id }}' class='form-check-input'>
                {{ $type->name }}
            </label>
        </div>
        @endforeach
        @error('type_id')
        <div class='invalid-feedback'>{{ $message}}</div>
        @enderror
    </div>

    <div class='form-group mb-3'>
        <p>Seleziona i technology:</p>
        @foreach ($technologies as $technology)
        <div class="form-check @error('technologies') is-invalid @enderror">
            <label class='form-check-label'>
                <input name='technologies[]' type='checkbox' value='{{ $technology->id}}' class='form-check-input' {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}>
                {{ $technology->name }}
            </label>
        </div>
        @endforeach
        @error('technologies')
            <div class='invalid-feedback'>{{ $message}}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="overview" class="form-label fw-bold">Overview</label>
        <textarea class="form-control @error('overview') is-invalid @enderror" name="overview" id="overview" rows="3">
        {{ old('overview') }}
        </textarea>
        <small id="helpId" class="text-muted">Add Overview</small>
        @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-success w-100 fw-bold fs-5">C R E A T E</button>

</form>

@endsection