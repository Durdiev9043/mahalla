<form action="{{ url('/compare-faces') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="image1">Rasm 1:</label>
    <input type="file" name="image1" id="image1" required>
    <br>
    <label for="image2">Rasm 2:</label>
    <input type="file" name="image2" id="image2" required>
    <br>
    <button type="submit">Taqqoslash</button>
</form>
