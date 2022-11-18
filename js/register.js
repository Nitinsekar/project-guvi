const regForm = document.querySelector(".register form");
const emaInp = document.querySelector("#email");
const passInp = document.querySelector("#password");

const msg = document.querySelector("#msg");

regForm.addEventListener("submit", (e) => {
    e.preventDefault();
    // window.location = '/guvi/index.html'
    const formData = {
        email: emaInp.value,
        password: passInp.value
    }
    $.ajax({
        type: "POST",
        url: "./php/register.php",
        data: formData,
        dataType: "json",
        encode: true,
      })
        .done(function(data) {
          msg.innerText = data.message;
          setTimeout(function () {
            window.location = "/guvi/login.html";
          }, 2000);
        })
        .fail(function (data) {
            console.log(data["responseText"])
          msg.innerText = data["responseText"] 
        });
})