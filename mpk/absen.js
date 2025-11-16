const tanggal = document.getElementById("tanggal");
const Day = new Date();
tanggal.innerText = Day.toDateString();

document.querySelectorAll("select[name^='absen']").forEach((select) => {
  select.addEventListener("change", function () {
    const idSiswa = this.name.match(/\d+/)[0];
    const statusBaru = this.value;

    console.log("Update:", idSiswa, "->", statusBaru);

    fetch("absen.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: `id_siswa=${idSiswa}&status=${statusBaru}`,
    })
      .then((res) => res.text())
      .then((result) => console.log("SERVER:", result))
      .catch((err) => {
        console.error("ERROR UPDATE:", err);
        alert("Gagal menyimpan status!");
      });
  });
});

//! AssistiveTouch
const ball = document.getElementById("assistiveTouch");
const menu = document.getElementById("assistiveMenu");
const modalBackdrop = document.getElementById("modalBackdrop");
const modalContent = document.getElementById("modalContent");

let isDragging = false,
  hasMoved = false;
let offsetX = 0,
  offsetY = 0;

function showModal(html) {
  modalContent.innerHTML = html;
  modalBackdrop.style.display = "flex";
}
function closeModal() {
  modalBackdrop.style.display = "none";
}

modalBackdrop.addEventListener("click", (e) => {
  if (e.target === modalBackdrop) closeModal();
});

function startDrag(e) {
  isDragging = true;
  hasMoved = false;
  const evt = e.touches ? e.touches[0] : e;
  offsetX = evt.clientX - ball.offsetLeft;
  offsetY = evt.clientY - ball.offsetTop;
  ball.style.transition = "none";
  document.addEventListener("mousemove", drag);
  document.addEventListener("mouseup", endDrag);
  document.addEventListener("touchmove", drag);
  document.addEventListener("touchend", endDrag);
}

function drag(e) {
  if (!isDragging) return;
  hasMoved = true;
  const evt = e.touches ? e.touches[0] : e;
  let x = evt.clientX - offsetX;
  let y = evt.clientY - offsetY;
  y = Math.max(10, Math.min(window.innerHeight - ball.offsetHeight - 10, y));
  ball.style.left = x + "px";
  ball.style.top = y + "px";
  menu.style.display = "none";
}

function endDrag() {
  isDragging = false;
  document.removeEventListener("mousemove", drag);
  document.removeEventListener("mouseup", endDrag);
  document.removeEventListener("touchmove", drag);
  document.removeEventListener("touchend", endDrag);

  const rect = ball.getBoundingClientRect();
  const middle = window.innerWidth / 2;
  ball.style.transition = "all 0.3s ease";
  if (rect.left + rect.width / 2 < middle) ball.style.left = "10px";
  else ball.style.left = window.innerWidth - rect.width - 10 + "px";
  setTimeout(() => (hasMoved = false), 50);
}

ball.addEventListener("mousedown", startDrag);
ball.addEventListener("touchstart", startDrag);

ball.addEventListener("click", () => {
  if (hasMoved) return;

  if (menu.style.display === "flex") {
    menu.style.animation = "bubbleOut 0.25s ease forwards";
    setTimeout(() => (menu.style.display = "none"), 250);
  } else {
    const rect = ball.getBoundingClientRect();
    menu.style.top = rect.top - 100 + "px";
    menu.style.left =
      rect.left < window.innerWidth / 2
        ? rect.right + 10 + "px"
        : rect.left - 280 + "px";
    menu.style.display = "flex";
    menu.style.animation = "bubble 0.25s ease forwards";
  }
});

document.addEventListener("click", (e) => {
  if (!menu.contains(e.target) && e.target !== ball) {
    menu.style.display = "none";
  }
});

//todo :  Help buttons
document.getElementById("helpBtnDesktop").addEventListener("click", showHelp);
document.getElementById("helpBtnMobile").addEventListener("click", showHelp);

function showHelp(e) {
  e.stopPropagation();
  const html = `
    <h3>Tata Cara Penggunaan</h3>
    <p class="small">Panduan singkat: Cari siswa dengan search, pilih status lewat dropdown. Setelah selesai klik Kirim untuk menyimpan rekap Absen hari ini.</p>
    <div class="help-grid" style="margin-top:8px">
      <div class="help-images">
        <img src="../asset/search.jpg" alt="mock1" />
        <img src="../asset/status.jpg" alt="mock2" />
        <img src="../asset/kirim.jpg" alt="mock3" />
      </div>
      <div style="flex:1">
        <p class="small">Fitur:</p>
        <ul style="margin:0 0 12px 18px;color:var(--muted)">
          <li>Pencarian</li>
          <li>AssistiveTouch</li>
          <li>Simple profile</li>
          <li>Colored Status</li>
          <li>History disimpan harian (localStorage)</li>
        </ul>
        <div class="actions">
          <button class="btn ghost" onclick="closeModal()">Tutup</button>
        </div>
      </div>
    </div>
  `;
  showModal(html);
}

document
  .getElementById("logout")
  .addEventListener("click", () => (window.location.href = "../logout.php"));
document
  .getElementById("utama")
  .addEventListener("click", () => window.location.reload());
