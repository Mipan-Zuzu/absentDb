const signInBtn = document.getElementById("signInBtn");
    const rightBox = document.getElementById("rightBox");
    const leftBox = document.getElementById("leftBox");
    const formTitle = document.getElementById("formTitle");
    const signUpBtn = document.getElementById("signUpBtn");
    const extraFields = document.getElementById("extraFields");

    signInBtn.addEventListener("click", () => {
      rightBox.classList.toggle("move-left");
      leftBox.classList.toggle("move-right");
      if (signUpBtn.innerText === "SIGN UP") {
        signUpBtn.innerText = "SIGN IN";
        formTitle.innerText = "Login Account";
      } else {
        signUpBtn.innerText = "SIGN UP";
        formTitle.innerText = "Create Account";
      }
    });

    document.getElementById("muridBtn").addEventListener("click", () => {
      extraFields.innerHTML = `
        <div class="input-box"><i class='bx bx-id-card'></i><input type="text" placeholder="NIS"></div>
        <div class="input-box"><i class='bx bx-id-card'></i><input type="text" placeholder="NISN"></div>
      `;
    });

    document.getElementById("guruBtn").addEventListener("click", () => {
      extraFields.innerHTML = `
        <div class="input-box"><i class='bx bx-id-card'></i><input type="text" placeholder="NIP"></div>
        <div class="input-box"><i class='bx bx-book'></i><input type="text" placeholder="Mata Pelajaran"></div>
      `;
    });

    document.getElementById("ortuBtn").addEventListener("click", () => {
      extraFields.innerHTML = `
        <div class="input-box"><i class='bx bx-id-card'></i><input type="text" placeholder="No KK"></div>
        <div class="input-box"><i class='bx bx-phone'></i><input type="text" placeholder="No Telepon"></div>
      `;
    });