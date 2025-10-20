function showCard(type) {
  const card = document.getElementById("card-container");
  let html = "";
  if (type === "pencil") {
    html = `<h2><i class='bx bx-pencil' style='color:#ffe066;font-size:2rem;'></i> Create</h2><p>Menambah data baru ke dalam sistem.</p>`;
  } else if (type === "book") {
    html = `<h2><i class='bx bx-book' style='color:#4dabf7;font-size:2rem;'></i> Read</h2><p>Melihat atau membaca suatu data yang sudah ada di sistem.</p>`;
  } else if (type === "refresh") {
    html = `<h2><i class='bx bx-refresh' style='color:#51cf66;font-size:2rem;'></i> Update</h2><p>Mengedit atau menambahkan suatu data yang sudah ada.</p>`;
  } else if (type === "trash") {
    html = `<h2><i class='bx bx-trash' style='color:#ffa94d;font-size:2rem;'></i> Delete</h2><p>Menghapus suatu data yang sudah tidak di perlukan.</p>`;
  }
  html += `<button class='card-close-btn' onclick='closeCard()'>Close</button>`;
  card.innerHTML = html;
  card.style.display = "flex";
}
function closeCard() {
  document.getElementById("card-container").style.display = "none";
}

function calls() {
  const inputs = document.getElementById("inputss").value;
  const output = document.getElementById("output");

  fetch(
    `https://api.ypnk.dpdns.org/api/ai/ypai?text=hai`
  )
    .then((response) => response.json())
    .then((data) => {
      console.log(data);

      output.innerHTML = data.answer || JSON.stringify(data, null, 2);
    })
    .catch((error) => console.error("Error:", error));
}

calls()

function login() {
  window.location.href = "/belajarPhp/loginn.php";
}

