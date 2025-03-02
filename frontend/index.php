<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Notes App</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/luxon/3.3.0/luxon.min.js"></script> 

    <style>
        /* Warna pastel untuk kategori */
        

        label {
            font-size: 16px;
            font-weight: bold;
        }

        #categoryFilter {
            padding: 10px;
            font-size: 14px;
            border-radius: 4px;
            border: 2px solid #ccc;
            background: color #e2ceb1;;
            cursor: pointer;
            transition: 0.3s;
        }

        #categoryFilter:hover {
            background-color: #e6e6e6;
        }


        /* Warna dropdown per kategori */
        option[value="tugas"] { background-color: #E3EAED; }  
        option[value="hutang"] { background-color: #F9E6E6; } 
        option[value="kerja"] { background-color: #E9F2EB; }  
        option[value="penting"] { background-color: #FCF6DA; }
        option[value="lainnya"] { background-color: #F0E8F0; }


        /* Container utama */
    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 20px;
    }

    /* Header dengan logo */
    .title-container {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        font-size: 32px;
        font-weight: bold;
        color: #444;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
    }

    .logo-kucing {
        height: 50px;
        width: auto;
        transition: transform 0.3s ease-in-out;
    }

    .logo-kucing:hover {
        transform: rotate(10deg) scale(1.1);
    }

    /* Filter Kategori */
    .filter-container {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
        background: #fff;
        padding: 10px 16px;
        border-radius: 12px;
        box-shadow: 2px 4px 10px rgba(0, 0, 0, 0.1);
    }

    label {
        font-size: 16px;
        font-weight: bold;
        color: #555;
    }

    #categoryFilter {
        padding: 10px;
        font-size: 14px;
        border-radius: 8px;
        border: 2px solid #ddd;
        background: #f9f9f9;
        cursor: pointer;
        transition: 0.3s;
    }

    #categoryFilter:hover {
        background-color: #f0f0f0;
        border-color: #bbb;
    }

    /* Tombol Tambah Catatan */
    .add-note-btn {
        background: linear-gradient(135deg, #ff85a2, #ff5c8a);
        color: white;
        border: none;
        padding: 12px 24px;
        font-size: 16px;
        font-weight: bold;
        border-radius: 25px;
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        transition: 0.3s ease-in-out;
        box-shadow: 2px 4px 10px rgba(255, 92, 138, 0.5);
    }

    .add-note-btn:hover {
        background: linear-gradient(135deg, #ff5c8a, #ff2e70);
        transform: scale(1.05);
        box-shadow: 2px 4px 15px rgba(255, 92, 138, 0.7);
    }

    .icon-plus {
        width: 18px;
        height: 18px;
    }


        /* Tombol Edit dan Delete */
        .note-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .edit-btn, .delete-btn {
            border: none;
            padding: 8px 12px;
            font-size: 14px;
            font-weight: bold;
            border-radius: 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: 0.3s;
            box-shadow: 2px 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Tombol Edit (Biru Pastel) */
        .edit-btn {
            background-color:rgb(67, 128, 188);
            color: white;
        }

        .edit-btn:hover {
            background-color: #87B4E0;
            transform: scale(1.05);
        }

        /* Tombol Delete (Merah Pastel) */
        .delete-btn {
            background-color:rgb(244, 119, 119);
            color: white;
        }

        .delete-btn:hover {
            background-color: #E69A9A;
            transform: scale(1.05);
        }

        /* Ikon tombol */
        .icon {
            width: 16px;
            height: 16px;
        }
    /* Container untuk grid notes */
    .notes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 16px;
        width: 100%;
        max-width: 1000px;
        margin-top: 20px;
    }
    /* Style untuk kartu catatan */
.note-card {
    padding: 16px;
    border-radius: 12px;
    box-shadow: 2px 4px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease-in-out;
}

.tugas { background-color: #E3EAED; }
.hutang { background-color: #F9E6E6; }  
.kerja { background-color: #E9F2EB; }   
.penting { background-color: #FCF6DA; } 
.lainnya { background-color: #F0E8F0; } 


.note-card:hover {
    transform: translateY(-5px);
    box-shadow: 2px 4px 15px rgba(0, 0, 0, 0.15);
}

.note-title {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 8px;
}

.note-content {
    font-size: 14px;
    color: #555;
    margin-bottom: 12px;
}

.note-updated {
    font-size: 12px;
    color: #888;
}

/* Responsif */
@media (max-width: 500px) {
    .filter-container {
        flex-direction: column;
        gap: 6px;
        width: 100%;
    }

    .add-note-btn {
        width: 100%;
        justify-content: center;
    }
}

    </style>
</head>
<body>

<div class="container">
    <h1>
        <div class="title-container">
            MeowNotes
            <img src="assets/kucing.png" alt="Logo Kucing" class="logo-kucing">
        </div>
    </h1>

    <!-- Dropdown filter kategori -->
    <div class="filter-container">
        <label for="categoryFilter">Kategori:</label>
        <select id="categoryFilter" onchange="fetchNotes()">
            <option value="">Semua</option>
            <option value="tugas">Tugas</option>
            <option value="hutang">Hutang</option>
            <option value="kerja">Kerja</option>
            <option value="penting">Penting</option>
            <option value="lainnya">Lainnya</option>
        </select>
    </div>

    <button class="add-note-btn" onclick="window.location.href='add_note.php'">
        <img src="assets/plus.png" alt="Add" class="icon-plus"> Add New Note
    </button>

    <div class="notes-grid" id="notesContainer"></div>
</div>

<script>
$(document).ready(function() {
    fetchNotes();
});

function fetchNotes() {
    const selectedCategory = document.getElementById("categoryFilter").value;
    fetch("http://localhost:4000/notes")
        .then(response => response.json())
        .then(data => {
            let notesHtml = "";
            
            data.forEach(note => {
                // Daftar kategori utama
                const kategoriUtama = ["tugas", "hutang", "kerja", "penting"];
                
                // Jika kategori tidak ada atau tidak termasuk kategori utama, masukkan ke "lainnya"
                let categoryClass = note.category && kategoriUtama.includes(note.category.toLowerCase()) 
                    ? note.category.toLowerCase() 
                    : "lainnya";
                
                if (selectedCategory && categoryClass !== selectedCategory) return;

                const updatedAtWIB = luxon.DateTime.fromISO(note.updatedAt, { zone: 'utc' })
                    .setZone('Asia/Jakarta')
                    .toFormat('dd MMMM yyyy HH:mm:ss');

                notesHtml += `
                    <div class="note-card ${categoryClass}">
                        <h3 class="note-title">${note.title}</h3>
                        <p class="note-content">${note.content}</p>
                        <p class="note-updated">Updated: ${updatedAtWIB} WIB</p>
                        <div class="note-buttons">
                                <button class="edit-btn" onclick="editNote(${note.id})">
                                    <img src="assets/edit.png" alt="Edit" class="icon"> Edit
                                </button>
                                <button class="delete-btn" onclick="deleteNote(${note.id})">
                                    <img src="assets/delete.png" alt="Delete" class="icon"> Delete
                                </button>
                            </div>
                        
                    </div>`;
                    
            });
            document.getElementById("notesContainer").innerHTML = notesHtml;
        });
}

function editNote(id) {
    window.location.href = `edit_note.php?id=${id}`;
}

function deleteNote(id) {
    if (confirm("Yaqeen kamu deck?")) {
        $.ajax({
            url: `http://localhost:4000/delete-notes/${id}`,
            type: "DELETE",
            success: function() {
                alert("Note deleted successfully!");
                fetchNotes();
            },
            error: function() {
                alert("Failed to delete note.");
            }
        });
    }
}
</script>

</body>
</html>
