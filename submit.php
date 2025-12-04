<?php
require_once __DIR__ . '/config/db.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require __DIR__ . '/vendor/autoload.php'; // PHPMailer autoload

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Formdan gelen verileri al
    $adsoyad = trim($_POST['adsoyad'] ?? '');
    $mailadres   = trim($_POST['email'] ?? '');
    $telefon = trim($_POST['telefon'] ?? '');
    $mesaj   = trim($_POST['mesaj'] ?? '');

    // Veritabanına kaydet
    $stmt = $mysqli->prepare("INSERT INTO iletisim (adsoyad, mail, telefon, mesaj) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $adsoyad, $mailadres, $telefon, $mesaj);


    if($mysqli->connect_error){
        die("Bağlantı hatası: " . $mysqli->connect_error);
    } else {
        echo "Veritabanı bağlantısı OK <br>";
    }
 
    if ($stmt->execute()) {
        echo "Kayıt başarıyla eklendi!<br>";
    } else {
        echo "Hata: " . $stmt->error . "<br>";
    }

    // Mail gönder
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'iletisimformu02@gmail.com';      // kendi mail adresin
        $mail->Password   = '';       // Google uygulama şifresi
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('iletisimformu02@gmail.com', 'Contact Form');
        $mail->addAddress('iletisimformu02@gmail.com');        // mesajların gideceği adres
        $mail->Subject = "Contact Form";
        $mail->Body  = "Ad: ".$adsoyad."\nmail: ".$mailadres."\nTelefon: ".$telefon."\nMesaj: ".$mesaj;
        //$mail->Body    = "Test";
        $mail->send();
        echo "Kayıt ve mail gönderildi ";
    } catch (Exception $e) {
    echo "Kayıt yapıldı ama mail gönderilemedi  Hata: {$e->getMessage()}";
    }
}

