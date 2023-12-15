<x-app-layout>
    <!-- Add your styles within a <style> tag -->
    <x-slot name="header">
        <h1 class="text-2xl font-semibold leading-tight text-gray-800">
            Uploaded Files
        </h1>
    </x-slot>

    <style>
        /* Google Drive style for file list */
        .file-list-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .file-list-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .file-list-table th,
        .file-list-table td {
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
            text-align: left;
        }

        .file-actions a {
            margin-right: 10px;
            text-decoration: none;
            color: #4285f4;
        }

        .file-actions a:hover {
            text-decoration: underline;
        }

        .no-files-message {
            font-size: 18px;
            color: #666;
            margin-top: 20px;
        }
    </style>

    <!-- Page Content -->
    <div class="file-list-container">
        <div>
            @error('recipient_email')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
            @error('permission_level')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
            <!-- Success message -->
            @if (session('success'))
            <div id="status_response_id" class="text-green-500">{{ session('success') }}</div>
            <input type="hidden" id="email_sent_status" value="">
            @endif
            <!-- Error notification -->
            @if (session('error'))
            <div class="text-red-500">{{ session('error') }}</div>
            @endif
        </div>

        <!-- Search input field -->
        <input type="text" id="searchInput" placeholder="Search by filename" style="width:100%; margin-bottom: 10px;">

        <!-- File list table -->
        @if (count($files) > 0)
        <table class="file-list-table">
            <!-- Table headers -->
            <thead>
                <tr>
                    <th>File Name</th>
                    <th>Actions</th>
                    <th>Share</th> <!-- Add a new column for Share File option -->
                </tr>
            </thead>
            <tbody id="fileList">
                <!-- Display files here -->
                @foreach ($files as $file)
                <tr>
                    <td>{{ $file->file_name }}</td>
                    <td class="file-actions">
                        <!-- Download and Delete buttons (existing actions) -->
                        <a href="{{ route('file.download', $file->id) }}">Download</a>
                        <form method="POST" action="{{ route('file.delete', $file->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this file?')">Delete</button>
                        </form>
                    </td>
                    <td class="file-share">
                        <!-- Share File form -->
                        <form method="POST" id="shareFileForm" action="{{ route('file.share', $file->id) }}">
                            @csrf
                            <input type="email" name="recipient_email" placeholder="Recipient's Email" required>
                            <select name="permission_level" required>
                                <option value="read">Read</option>
                                <!-- Add more permission options as needed -->
                            </select>
                            <button type="submit">Share</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p class="no-files-message">No files uploaded yet.</p>
        @endif
    </div>

    <!-- JavaScript for file search -->
    <script defer>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const fileList = document.getElementById('fileList');

            searchInput.addEventListener('input', function(event) {
                const searchQuery = event.target.value.toLowerCase();
                const files = fileList.getElementsByTagName('tr');

                for (let i = 0; i < files.length; i++) {
                    const fileName = files[i].getElementsByTagName('td')[0].textContent.toLowerCase();

                    if (fileName.includes(searchQuery)) {
                        files[i].style.display = ''; // Show file if filename matches search query
                    } else {
                        files[i].style.display = 'none'; // Hide file if filename does not match
                    }
                }
            });
        });
    </script>
</x-app-layout>
