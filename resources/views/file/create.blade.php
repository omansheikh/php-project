<x-app-layout>
    <style>
        /* Google Drive style for file upload form */
        .upload-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 3.5rem); /* Adjust this value according to your header height */
            background-color: #f5f5f5;
        }

        .upload-card {
            width: 100%;
            max-width: 500px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .upload-header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #4285f4;
            text-align: center;
        }

        .upload-success {
            margin-bottom: 20px;
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
            padding: 10px;
            border-radius: 4px;
            text-align: center;
        }

        .file-input {
            margin-bottom: 20px;
        }

        .upload-button {
            padding: 10px 20px;
            background-color: #4285f4;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
            display: block;
            text-align: center;
        }

        .upload-button:hover {
            background-color: #3367d6;
        }

        /* Styling for file input */
        .file-input input[type="file"] {
            display: none;
        }

        .file-input label {
            padding: 10px 20px;
            background-color: #4285f4;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: inline-block;
            text-align: center;
        }

        .file-input label:hover {
            background-color: #3367d6;
        }

        .file-input label::before {
            content: 'Select a File';
        }

        /* Visual indication for selected file */
        .file-input input[type="file"]:focus + label,
        .file-input input[type="file"]:valid + label {
            background-color: #3367d6;
        }

        .file-input input[type="file"]:focus + label::before,
        .file-input input[type="file"]:valid + label::before {
            content: attr(data-filename);
            color: #fff;
        }
    </style>

    <div class="upload-container">
        <div class="upload-card">
            <div class="upload-header">Upload a File</div>

            @if(session('success'))
                <div class="upload-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('file.store') }}" method="POST" enctype="multipart/form-data" class="file-input">
                @csrf

                <input type="file" name="file" id="file" required onchange="document.getElementById('file').setAttribute('data-filename', this.files[0].name)">
                <label for="file" data-filename="Select a File">Select a File</label>

                <button type="submit" class="upload-button">Upload File</button>
            </form>
        </div>
    </div>
</x-app-layout>
