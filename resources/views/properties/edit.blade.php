<!-- resources/views/properties/edit.blade.php -->

@extends('layouts.app')

@section('body')
<div class="container">
    <h1>Edit Property</h1>

    <form action="{{ route('properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Form fields for Property details -->
        <div class="form-group">
            <label for="name">Property Name</label>
            <input type="text" name="name" class="form-control" value="{{ $property->name }}" required>
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" class="form-control" value="{{ $property->address }}" required>
        </div>

        <div class="form-group">
            <label for="type">Type</label>
            <select name="type" class="form-control" required>
                <option value="apartment" {{ $property->type == 'apartment' ? 'selected' : '' }}>Apartment</option>
                <option value="house" {{ $property->type == 'house' ? 'selected' : '' }}>House</option>
            </select>
        </div>

        <div class="form-group">
            <label for="number_of_units">Number of Units</label>
            <input type="number" name="number_of_units" class="form-control" value="{{ $property->number_of_units }}" required>
        </div>

        <div class="form-group">
            <label for="rental_cost">Rental Cost</label>
            <input type="number" name="rental_cost" class="form-control" value="{{ $property->rental_cost }}" required>
        </div>

        <!-- Display Existing Images with Remove Option -->
        <div class="form-group">
            <label>Existing Images</label>
            <div id="existing-images" style="display: flex; gap: 10px; flex-wrap: wrap;">
                @foreach ($property->images as $image)
                    <div style="position: relative; width: 100px;">
                        <img src="{{ asset('storage/' . $image->image_path) }}" style="width: 100px; height: 100px; object-fit: cover;">
                        <button type="button" class="btn btn-danger btn-sm" style="position: absolute; top: 5px; right: 5px;" onclick="removeExistingImage({{ $image->id }})">X</button>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Hidden input to keep track of images to delete -->
        <input type="hidden" name="delete_images" id="delete_images">

        <!-- File Input for Adding New Images with Preview -->
        <div class="form-group">
            <label for="images">Add New Images</label>
            <input type="file" name="images[]" class="form-control" id="images" accept="image/*" multiple>
        </div>

        <!-- New Image Preview Area -->
        <div id="image-preview-container" style="display: flex; gap: 10px; flex-wrap: wrap;"></div>

        <button type="submit" class="btn btn-primary">Update Property</button>
    </form>
</div>

<!-- JavaScript for Image Preview and Removal -->
<script>
    const imagesInput = document.getElementById('images');
    const previewContainer = document.getElementById('image-preview-container');
    let deleteImages = [];

    function removeExistingImage(imageId) {
        deleteImages.push(imageId);
        document.getElementById('delete_images').value = deleteImages.join(',');
        document.getElementById('existing-images').querySelector(`[onclick="removeExistingImage(${imageId})"]`).parentElement.remove();
    }

    imagesInput.addEventListener('change', (event) => {
        previewContainer.innerHTML = '';
        Array.from(event.target.files).forEach((file) => {
            const reader = new FileReader();
            reader.onload = (e) => {
                const imagePreview = document.createElement('div');
                imagePreview.style.position = 'relative';
                imagePreview.style.width = '100px';
                imagePreview.style.marginBottom = '10px';

                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.width = '100px';
                img.style.height = '100px';
                img.style.objectFit = 'cover';
                img.style.borderRadius = '5px';

                const removeButton = document.createElement('button');
                removeButton.innerText = 'X';
                removeButton.style.position = 'absolute';
                removeButton.style.top = '5px';
                removeButton.style.right = '5px';
                removeButton.style.backgroundColor = 'red';
                removeButton.style.color = 'white';
                removeButton.style.border = 'none';
                removeButton.style.borderRadius = '50%';
                removeButton.style.cursor = 'pointer';
                removeButton.onclick = () => imagePreview.remove();

                imagePreview.appendChild(img);
                imagePreview.appendChild(removeButton);
                previewContainer.appendChild(imagePreview);
            };
            reader.readAsDataURL(file);
        });
    });
</script>
@endsection
