<?php $id = $_GET['id']; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Note</title>
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

<h1>Edit Note</h1>
<form id="editNoteForm">
    <input type="hidden" id="id" value="<?= $id ?>">
    
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

    <button type="submit">Update Note</button>
</form>

<script>
$(document).ready(function() {
    let noteId = $("#id").val();
    
    $.get(`http://localhost:4000/notes/${noteId}`, function(note) {
        if (note) {
            $("#title").val(note.title);
            $("#content").val(note.content);
            $("#category").val(note.category);
        } else {
            alert("Note not found.");
        }
    }).fail(function() {
        alert("Error fetching note.");
    });

    $("#editNoteForm").submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: `http://localhost:4000/edit-notes/${noteId}`,
            type: "PUT",
            contentType: "application/json",
            data: JSON.stringify({
                title: $("#title").val(),
                content: $("#content").val(),
                category: $("#category").val()
            }),
            success: function() {
                alert("Note updated successfully!");
                window.location.href = "index.php";
            },
            error: function() {
                alert("Error updating note.");
            }
        });
    });
});
</script>

</body>
</html>
