<script>
  function updateDateTime() {
    const now = new Date();

    // Format waktu (HH:MM:SS)
    const timeOptions = {
      hour: '2-digit',
      minute: '2-digit',
      second: '2-digit',
      hour12: false
    };
    const formattedTime = now.toLocaleTimeString('id-ID', timeOptions).replace(/\./g, ':');

    // Format tanggal lengkap (Hari, DD MMMM YYYY)
    const dateOptions = {
      weekday: 'long',
      day: '2-digit',
      month: 'long',
      year: 'numeric'
    };
    const formattedDate = now.toLocaleDateString('id-ID', dateOptions);

    // Tentukan ikon berdasarkan waktu
    const hour = now.getHours();
    let icon;
    if (hour >= 6 && hour < 18) {
      icon = '<i class="las la-sun"></i>'; // Siang
    } else {
      icon = '<i class="las la-moon"></i>'; // Malam
    }

    // Set jam dan ikon dalam satu elemen
    document.getElementById('time-icon').innerHTML = `${icon} ${formattedTime}`;

    // Set tanggal lengkap tanpa span
    document.getElementById('date-text').textContent = formattedDate;
  }

  // Jalankan saat halaman dimuat
  window.onload = updateDateTime;

  // Perbarui waktu setiap detik agar real-time
  setInterval(updateDateTime, 1000);
</script>
