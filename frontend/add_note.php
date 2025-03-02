<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Add Note</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="assets/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            text-align: center;
            padding: 20px;
        }

        h1 {
            color: #ff85a2; /* Warna pink pastel */
        }

        form {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 2px 4px 10px rgba(0, 0, 0, 0.1);
            display: inline-block;
            text-align: left;
            width: 300px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        input, textarea, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            background-color: #ff85a2;
            color: white;
            border: none;
            padding: 10px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 25px;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 15px;
            width: 100%;
        }

        button:hover {
            background-color: #ff5c8a;
            box-shadow: 2px 4px 15px rgba(255, 92, 138, 0.7);
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<h1>Add New Note</h1>
<form id="addNoteForm">
    <label>Title:</label>
    <input type="text" id="title" required>

    <label>Content:</label>
    <textarea id="content" required></textarea>

    <label>Category:</label>
    <select id="category" required>
        <option value="tugas">Tugas</option>
        <option value="hutang">Hutang</option>
        <option value="kerja">Kerja</option>
        <option value="penting">Penting</option>
        <option value="lainnya">Lainnya</option>
    </select>

    <button type="submit">Add Note</button>
</form>

<script>
$("#addNoteForm").submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: "http://localhost:4000/add-notes",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify({
            title: $("#title").val(),
            content: $("#content").val(),
            category: $("#category").val()
        }),
        success: function() {
            alert("Note added successfully!");
            window.location.href = "index.php";
        },
        error: function() {
            alert("Error adding note.");
        }
    });
});
</script>

</body>
</html>
