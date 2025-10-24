console.log("main.js terbaca ✅");

console.log("Elemen Desktop:", document.getElementById("listDesktop"));
console.log("Elemen Mobile:", document.getElementById("listMobile"));

function initStudents() {
  fetch("getSiswa.php")
    .then(res => res.json())
    .then(data => {
      state.students = data.map(s => ({ ...s, status: "hadir" }));
      renderAll();
    })
    .catch(err => {
      console.error("Gagal ambil data siswa:", err);
    });
}


const state = {
  students: [],
  filter: "",
  date: new Date().toISOString().slice(0, 10),
  history: loadHistory(),
};

function q(id) {
  return document.getElementById(id);
}
function createElem(tag, cls) {
  const el = document.createElement(tag);
  if (cls) el.className = cls;
  return el;
}

function statusColor(status) {
  switch (status) {
    case "hadir":
      return ["Hadir", "#23b26a", "hadir"];
    case "izin":
      return ["Izin", "#ffb020", "izin"];
    case "sakit":
      return ["Sakit", "#e23b3b", "sakit"];
    case "dispen":
      return ["Dispen", "#1fa7ff", "dispen"];
    case "alpha":
    default:
      return ["Alpha", "#bdbdbd", "alpha"];
  }
}

function renderStudentItem(student, container, index) {
  const item = createElem("div", "student");
  item.dataset.id = student.id;

  const left = createElem("div", "left");
  const num = createElem("div", "num");
  num.textContent = index + 1;
  const text = createElem("div", "text");
  const name = createElem("div", "name");
  name.textContent = student.name;
  const small = createElem("div", "small");
  small.textContent = student.profile || "";
  text.appendChild(name);
  text.appendChild(small);

  left.appendChild(num);
  left.appendChild(text);

  const controls = createElem("div", "controls");

  const profileBtn = createElem("button", "btn ghost");
  profileBtn.style.padding = "6px 8px";
  profileBtn.textContent = "Profile";
  profileBtn.onclick = () => showProfileCard(student);

  const selectWrap = createElem("div", "select");
  const select = createElem("select");
  ["hadir", "izin", "sakit", "dispen", "alpha"].forEach((s) => {
    const op = document.createElement("option");
    op.value = s;
    op.textContent = s.charAt(0).toUpperCase() + s.slice(1);
    if (s === student.status) op.selected = true;
    select.appendChild(op);
  });
  select.onchange = (e) => {
    student.status = e.target.value;
    updateDot(dot, student.status);
    updateCounts();
  };

  const dot = createElem("span", "status-dot");
  updateDot(dot, student.status);

  selectWrap.appendChild(select);
  controls.appendChild(profileBtn);
  controls.appendChild(selectWrap);
  controls.appendChild(dot);

  item.appendChild(left);
  item.appendChild(controls);

  container.appendChild(item);
}

function updateDot(dot, status) {
  const [, color, cls] = statusColor(status);
  dot.style.background = color;
  dot.className = "status-dot " + cls;
  dot.title = status.charAt(0).toUpperCase() + status.slice(1);
}

function formatTanggal(d) {
  return d.toLocaleDateString("id-ID", {
    weekday: "long",
    year: "numeric",
    month: "long",
    day: "numeric",
  });
}

function renderAll() {
  const today = new Date();
  q("todayDesktop").textContent = formatTanggal(today);
  q("todayMobile").textContent = formatTanggal(today);

  const listD = q("listDesktop");
  listD.innerHTML = "";
  const listM = q("listMobile");
  listM.innerHTML = "";

  const filtered = state.students.filter((s) =>
    s.name.toLowerCase().includes(state.filter.toLowerCase())
  );

  filtered.forEach((s, i) => {
    renderStudentItem(s, listD, i);
    renderStudentItem(s, listM, i);
  });

  q("countDesktop").textContent = filtered.length;
  q("countMobile").textContent = filtered.length;
  q("totalDesktop").textContent = `${state.students.length} siswa`;
  q("totalMobile").textContent = `${state.students.length} siswa`;

  updateCounts();
  renderHistory();
}

function updateCounts() {
  const counts = state.students.reduce((acc, s) => {
    acc[s.status] = (acc[s.status] || 0) + 1;
    return acc;
  }, {});
}

q("searchDesktop").addEventListener("input", (e) => {
  state.filter = e.target.value;
  renderAll();
});
q("searchMobile").addEventListener("input", (e) => {
  state.filter = e.target.value;
  renderAll();
});

const modalBackdrop = q("modalBackdrop");
function showModal(html) {
  q("modalContent").innerHTML = html;
  modalBackdrop.style.display = "flex";
}
function closeModal() {
  modalBackdrop.style.display = "none";
}

function showProfileCard(student) {
  const html = `
    <h3>${escapeHtml(student.name)}</h3>
    <p class="small">${escapeHtml(student.profile || "")}</p>
    <div style="display:flex;gap:10px;margin-top:8px;align-items:center">
      <div style="width:72px;height:72px;border-radius:10px;background:#eef7ff"></div>
      <div style="flex:1">
        <div class="small">Status sekarang</div>
        <div style="margin-top:6px;font-weight:700">${
          student.status.charAt(0).toUpperCase() + student.status.slice(1)
        }</div>
      </div>
    </div>
    <div class="actions">
      <button class="btn ghost" onclick="closeModal()">Tutup</button>
    </div>
  `;
  showModal(html);
}

document.getElementById("helpBtnDesktop").onclick = showHelp;
document.getElementById("helpBtnMobile").onclick = showHelp;
function showHelp() {
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
          <li>assistiveTouch</li>
          <li>Simple profile</li>
          <li>Colord Status</li>
          <li>History di simpan harian (localStorage)</li>
        </ul>
        <div class="actions">
          <button class="btn ghost" onclick="closeModal()">Tutup</button>
        </div>
      </div>
    </div>
  `;
  showModal(html);
}

document.getElementById("submitBtnDesktop").onclick = submitHandler;
document.getElementById("submitBtnMobile").onclick = submitHandler;

function submitHandler() {
  const payload = {
    date: state.date,
    records: state.students.map((s) => ({
      id: s.id,
      name: s.name,
      status: s.status,
    })),
  };
  const summary = summarizeCounts(payload.records);
  const html = `
    <h3>Konfirmasi Pengiriman</h3>
    <p class="small">Apakah anda yakin akan mengirim daftar ini untuk tanggal <h3>${
      state.date
    }</h3>?</p>
    <div style="display:flex;gap:10px;margin-top:8px">
      <div><strong>Hadir:</strong> ${summary.hadir || 0}</div>
      <div><strong>Izin:</strong> ${summary.izin || 0}</div>
      <div><strong>Sakit:</strong> ${summary.sakit || 0}</div>
      <div><strong>Dispen:</strong> ${summary.dispen || 0}</div>
      <div><strong>Alpha:</strong> ${summary.alpha || 0}</div>
    </div>
    <div class="actions">
      <button class="btn ghost" onclick="closeModal()">Batal</button>
      <button class="btn primary" id="confirmSend">Ya, Kirim</button>
    </div>
  `;
  showModal(html);

  q("confirmSend").onclick = () => {
    saveToHistory(payload);
    closeModal();
    showModal(
      `<h3>Terkirim</h3><p class="small">Data berhasil disimpan untuk tanggal ${state.date}.</p><div class="actions"><button class="btn ghost" onclick="closeModal()">Tutup</button></div>`
    );
  };
}

document.getElementById("clearBtnDesktop").onclick = clearHandler;
document.getElementById("clearBtnMobile").onclick = clearHandler;
function clearHandler() {
  showModal(`<div class="AnimateFade"><h3>Kosongkan Formulir</h3><p class="small">Apakah anda yakin akan mengosongkan formulir ini? Semua status akan kembali ke <strong>Alpha</strong>.</p>
    <div class="actions">
      <button class="btn ghost" onclick="closeModal()">Batal</button>
      <button class="btn warn" id="confirmClear">Kosongkan</button>
    </div></div>`);
  q("confirmClear").onclick = () => {
    state.students.forEach((s) => (s.status = "alpha"));
    renderAll();
    closeModal();
  };
}

function saveToHistory(payload) {
  const hist = loadHistory();
  const idx = hist.findIndex((h) => h.date === payload.date);
  if (idx > -1) hist[idx] = payload;
  else hist.push(payload);
  localStorage.setItem("absen_history", JSON.stringify(hist));
  state.history = hist;
  renderHistory();
}

function loadHistory() {
  try {
    return JSON.parse(localStorage.getItem("absen_history") || "[]");
  } catch (e) {
    return [];
  }
}

function renderHistory() {
  const containerDesk = q("historyListDesktop");
  const containerMob = q("historyListMobile");
  if (!containerDesk || !containerMob) return;
  containerDesk.innerHTML = "";
  containerMob.innerHTML = "";
  const hist = state.history
    .slice()
    .sort((a, b) => b.date.localeCompare(a.date));
  if (hist.length === 0) {
    containerDesk.innerHTML = `<div class="small">Belum ada history.</div>`;
    containerMob.innerHTML = `<div class="small">Belum ada history.</div>`;
    return;
  }
  hist.forEach((h) => {
    const div = createElem("div", "day");
    const left = createElem("div", "left");
    const title = createElem("div");
    title.innerHTML = `<strong class="tanggal">${h.date}</strong>`;
    left.appendChild(title);
    const stats = summarizeCounts(h.records);
    const right = createElem("div", "stat-badges");
    ["hadir", "izin", "sakit", "dispen", "alpha"].forEach((k) => {
      const s = createElem("div");
      s.style.display = "flex";
      s.style.alignItems = "center";
      s.style.gap = "6px";
      s.style.fontSize = "13px";
      const dot = createElem("span");
      dot.className = "dot " + k;
      dot.style.width = "10px";
      dot.style.height = "10px";
      s.appendChild(dot);
      s.appendChild(document.createTextNode(stats[k] || 0));
      right.appendChild(s);
    });
    const detailBtn = createElem("button");
    detailBtn.textContent = "Detail";
    detailBtn.className = "btn ghost";
    detailBtn.style.padding = "6px 8px";
    detailBtn.onclick = () => showHistoryDetail(h);
    right.appendChild(detailBtn);
    div.appendChild(left);
    div.appendChild(right);
    containerDesk.appendChild(div);
    containerMob.appendChild(div.cloneNode(true));
  });
}

function showHistoryDetail(h) {
  const grouped = h.records.reduce((acc, r) => {
    (acc[r.status] = acc[r.status] || []).push(r);
    return acc;
  }, {});
  let html = `<h3>Detail ${h.date}</h3><div style="max-height:320px;overflow:auto">`;
  ["hadir", "izin", "sakit", "dispen", "alpha"].forEach((s) => {
    const list = grouped[s] || [];
    html += `<h4 style="margin:8px 0 4px 0">${
      s.charAt(0).toUpperCase() + s.slice(1)
    } (${list.length})</h4>`;
    if (list.length === 0) html += `<div class="small">-</div>`;
    else {
      list.forEach(
        (r) =>
          (html += `<div style="padding:6px 0;border-bottom:1px dashed #f0f2f5">${escapeHtml(
            r.name
          )}</div>`)
      );
    }
  });
  html += `</div><div class="actions"><button class="btn ghost" onclick="closeModal()">Tutup</button></div>`;
  showModal(html);
}

function summarizeCounts(records) {
  return records.reduce((acc, r) => {
    acc[r.status] = (acc[r.status] || 0) + 1;
    return acc;
  }, {});
}

function escapeHtml(s) {
  return String(s).replace(/[&<>"']/g, function (m) {
    return {
      "&": "&amp;",
      "<": "&lt;",
      ">": "&gt;",
      '"': "&quot;",
      "'": "&#39;",
    }[m];
  });
}

modalBackdrop.addEventListener("click", (e) => {
  if (e.target === modalBackdrop) closeModal();
});

q("historyToggle").onclick = () => {
  const el = q("historyDesktop");
  el.style.display =
    el.style.display === "none" || el.style.display === "" ? "block" : "none";
};

initStudents();

q("countDesktop").textContent = state.students.length;
q("countMobile").textContent = state.students.length;

const ball = document.getElementById("assistiveTouch");
const menu = document.getElementById("assistiveMenu");

let isDragging = false,
  offsetX,
  offsetY;

ball.addEventListener("mousedown", startDrag);
ball.addEventListener("touchstart", startDrag);

function startDrag(e) {
  isDragging = true;
  let evt = e.touches ? e.touches[0] : e;
  offsetX = evt.clientX - ball.offsetLeft;
  offsetY = evt.clientY - ball.offsetTop;
  document.addEventListener("mousemove", drag);
  document.addEventListener("mouseup", endDrag);
  document.addEventListener("touchmove", drag);
  document.addEventListener("touchend", endDrag);
}

function drag(e) {
  if (!isDragging) return;
  let evt = e.touches ? e.touches[0] : e;
  let x = evt.clientX - offsetX;
  let y = evt.clientY - offsetY;
  ball.style.left = x + "px";
  ball.style.top = y + "px";
}

function endDrag() {
  isDragging = false;
  document.removeEventListener("mousemove", drag);
  document.removeEventListener("mouseup", endDrag);
  document.removeEventListener("touchmove", drag);
  document.removeEventListener("touchend", endDrag);

  const screenWidth = window.innerWidth;
  const ballRect = ball.getBoundingClientRect();
  if (ballRect.left + ballRect.width / 2 < screenWidth / 2) {
    ball.style.left = "10px";
  } else {
    ball.style.left = screenWidth - ballRect.width - 10 + "px";
  }
}
ball.addEventListener("click", () => {
  if (menu.style.display === "flex") {
    menu.style.animation = "bubbleOut 0.25s ease forwards";
    setTimeout(() => {
      menu.style.display = "none";
    }, 500);
  } else {
    const rect = ball.getBoundingClientRect();
    menu.style.top = rect.top - 100 + "px";
    menu.style.left =
      rect.left < window.innerWidth / 2
        ? rect.right + 20 + "px"
        : rect.left - 280 + "px";
    menu.style.display = "flex";
    menu.style.animation = "bubble 0.25s ease forwards";
  }
});

function timesUp () {

  const d = new Date()
  const m = d.getMinutes()
  const h = d.getHours()
const time = `
<h2>${h} : ${m}</h2>`
document.querySelector('.time').innerHTML = time 
}
setInterval(timesUp,1000)

const user = document.getElementById('user')
const getUser = localStorage.getItem('nama')
getUser.came
user.textContent = getUser ? getUser : "guest"

