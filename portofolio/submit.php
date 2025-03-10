<?php
// Koneksi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contact_form";

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$successMessage = '';
$errorMessage = '';

// Proses form jika disubmit melalui AJAX
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message'])) {
    $message = $_POST['message'];

    // Validasi pesan kosong
    if (empty($message)) {
        $errorMessage = "Pesan tidak boleh kosong.";
    } else {
        // Query untuk menyimpan pesan ke database
        $sql = "INSERT INTO messages (message) VALUES ('$message')";
        if ($conn->query($sql) === TRUE) {
            $successMessage = "Pesan berhasil dikirim!";
        } else {
            $errorMessage = "Error: " . $conn->error;
        }
    }
}

// Menutup koneksi
$conn->close();

// Menampilkan pesan sukses atau error
if ($successMessage) {
    echo "<div class='success'>$successMessage</div>";
} elseif ($errorMessage) {
    echo "<div class='error'>$errorMessage</div>";
}
?>
