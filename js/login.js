const loginForm = document.querySelector(".login form");
const emaInp = document.querySelector("#email");
const passInp = document.querySelector("#password");

const msg = document.querySelector("#msg");

loginForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const formData = {
        email: emaInp.value,
        password: passInp.value
    }
    $.ajax({
        type: "POST",
        url: "./php/login.php",
        data: formData,
        dataType: "json",
        encode: true,
      })
        .done(function(data) {
          msg.innerText = data.message;
          console.log(data)
          localStorage.setItem("auth_token", data["token"]);
          setTimeout(function () {
            window.location = "/guvi/profile.html";
          }, 2000);
        })
        .fail(function (data) {
            console.log(data["responseText"])
          msg.innerText = data["responseText"] 
        });
})