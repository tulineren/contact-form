<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="UTF-8">
        <title>İletişim Formu</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">İletişim</a>
  </div>
</nav>

<div class="container mt-5">
  <h3>İletişim Formu</h3>
  <form id="iletisimFormu" method="POST">
    <div class="mb-3">
      <label for="adsoyad" class="form-label">Ad Soyad</label>
      <input type="text" class="form-control" id="adsoyad" name="adsoyad" required>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">E-posta</label>
      <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="mb-3">
      <label for="telefon" class="form-label">Telefon</label>
      <input type="text" class="form-control" id="telefon" name="telefon">
    </div>
    <div class="mb-3">
      <label for="mesaj" class="form-label">Mesaj</label>
      <textarea class="form-control" id="mesaj" name="mesaj" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Gönder</button>
  </form>
</div>


<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$("#iletisimFormu").submit(function(e){
  e.preventDefault(); // formun sayfa yenilemesini engeller
  $.ajax({
    url: "submit.php",       // verileri işleyecek dosya
    type: "POST",            // POST ile gönder
    data: $(this).serialize(), // form verilerini otomatik al
    success: function(response){
      alert("Sunucudan gelen cevap: " + response);
    },
    error: function(){
      alert("Bir hata oluştu.");
    }
  });
});
</script>

</body>
</html>

