<!-- share-file.blade.php -->
<form action="{{ route('file.share', $file->id) }}" method="POST">
    @csrf
    <label for="shared_with_user_id">User ID to Share With:</label>
    <input type="text" id="shared_with_user_id" name="shared_with_user_id" required>
    
    <label for="permission_level">Permission Level:</label>
    <input type="text" id="permission_level" name="permission_level" required>
    
    <button type="submit">Share File</button>
</form>
