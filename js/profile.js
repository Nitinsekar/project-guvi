const proForm = document.querySelector(".profile form");
const nameInp = document.querySelector("#name");
const birthInp = document.querySelector("#birthday");
const ageInp = document.querySelector("#age");
const addressInp = document.querySelector("#address");

const msg = document.querySelector("#msg");

proForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const auth_token = localStorage.getItem("auth_token");
    const formData = {
        auth_token,
        name: nameInp.value,
        birthday: birthInp.value,
        age: ageInp.value,
        address: addressInp.value,
    }
    console.log(formData)
    $.ajax({
        type: "POST",
        url: "./php/profile.php",
        data: formData,
        dataType: "json",
        encode: true,
      })
        .done(function(data) {
          msg.innerText = data.message;
        })
        .fail(function (data) {
            console.log(data["responseText"])
          msg.innerText = data["responseText"] 
        //   setTimeout(function () {
        //     window.location = "/guvi/login.html";
        //   }, 2000);
        });
})