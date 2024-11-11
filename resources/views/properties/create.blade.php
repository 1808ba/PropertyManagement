<!-- resources/views/properties/create.blade.php -->

@extends('layouts.app')

@section('body')
<div class="container">
    <h1>Add Property</h1>

    <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Form Fields for Property Information -->
        <div class="form-group">
            <label for="name">Property Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="type">Type</label>
            <select name="type" class="form-control" required>
                <option value="apartment">Apartment</option>
                <option value="house">House</option>
            </select>
        </div>

        <div class="form-group">
            <label for="number_of_units">Number of Units</label>
            <input type="number" name="number_of_units" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="rental_cost">Rental Cost</label>
            <input type="number" name="rental_cost" class="form-control" required>
        </div>

        <!-- File Input for Images with Preview -->
        <div class="form-group">
            <label for="images">Property Images</label>
            <input type="file" name="images[]" class="form-control" id="images" accept="image/*">
        </div>

        <!-- Image Preview Area -->
        <div id="image-preview-container" style="display: flex; gap: 10px; flex-wrap: wrap;"></div>

        <button type="submit" class="btn btn-primary">Add Property</button>
    </form>
</div>

<!-- JavaScript for Image Preview and Removal -->
<script>
    const imagesInput = document.getElementById('images');
    const previewContainer = document.getElementById('image-preview-container');
    let selectedFiles = [];

    imagesInput.addEventListener('change', (event) => {
        const files = Array.from(event.target.files);

        files.forEach((file) => {
            selectedFiles.push(file);

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

                removeButton.addEventListener('click', () => {
                    selectedFiles = selectedFiles.filter((f) => f !== file);
                    imagePreview.remove();
                });

                imagePreview.appendChild(img);
                imagePreview.appendChild(removeButton);
                previewContainer.appendChild(imagePreview);
            };
            reader.readAsDataURL(file);
        });

        // Clear the input so that user can select the same file again if needed
        imagesInput.value = '';
    });
</script>
@endsection
