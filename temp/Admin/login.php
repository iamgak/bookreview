<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Post Listing</title>
    <link rel="stylesheet" href="/my_blog/assets/css/style.css">
    <!-- <style>
        /* Resetting default margin and padding */
        
           </style> -->
    <!-- Link to your CSS file -->
</head>

<body>
<div class="container" id="input">
    <!-- Register Form -->
    <form id="main-form" data-id='post_form' method="POST">
            <div class="title">Admin Login</div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="text" id="password" name="password">
            </div>
            <div class="form-group">
                <button type="submit">Login ?</button>
            </div>
        </form>

    </div>
<script>
    let post_ad = document.querySelector(".container #main-form");
if (post_ad && post_ad.getAttribute("data-id") == "post_form") {
  post_ad
    .querySelector('button[type="submit"]')
    .addEventListener("click", (event) => {
      event.preventDefault();
      event.stopPropagation();

      let formData = new FormData(post_ad);
      fetch(window.location.href, {
        method: "POST",
        body: formData,
      })
        .then((res) => res.json())
        .then((data) => {
          let p = document.querySelector("#main-form > .err_msg");
          if(data.message){
            if (p == null) {
              let parent = document.querySelector("#main-form");
              let form_group = parent.querySelector(" .form-group");
              p = document.createElement("p");
              p.classList.add("message");
              p.innerHTML = data["message"];
              parent.insertBefore(p, form_group);
            } else {
              p.innerHTML = dats["message"];
            }
          }else if (data.location) {
            window.location.href = data.location
        }else if (data.error) {
            let err = data.error;
            if (err["invalid"]) {
              let parent = document.querySelector("#main-form");
              if (p == null) {
                let form_group = parent.querySelector(" .form-group");
                p = document.createElement("p");
                p.classList.add("err_msg");
                p.innerHTML = err["invalid"];
                parent.insertBefore(p, form_group);
                console.log(parent, "hello", p);
              } else {
                p.innerHTML = err["invalid"];
              }
            } else {
              if (p) {
                p.remove();
              }
            }

            post_ad
              .querySelectorAll("input,textarea,select")
              .forEach((input) => {
                let parent = input.closest(".form-group");
                let p = parent.querySelector("p");
                if (err && err[input.name]) {
                  input.style.border = "2px solid red";
                  input.placeholder = err[input.name];
                  let p = input
                    .closest(".form-group")
                    .querySelector(".err_msg");
                  if (p) {
                    p.innerHTML = err[input.name];
                  } else {
                    p = document.createElement("p");
                    p.innerHTML = err[input.name];
                    p.classList.add("err_msg");
                    input.closest(".form-group").appendChild(p);
                  }
                } else {
                  if (p) {
                    p.remove();
                  }
                  input.style.border = "2px solid green";
                }
              });
          }
        })
        .catch((err) => console.log(err));
    });
}
</script>
</body>

</html>