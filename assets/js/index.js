function readmore(curr) {
  console.log(curr);
  var elem = curr.closest(".list").querySelector(".content");

  if (elem.classList.contains("expanded")) {
    elem.classList.remove("expanded");
  } else {
    elem.classList.add("expanded");
  }
}
function go_to(link) {
  window.location.href = link;
}
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
          if (data.message) {
            if (p == null) {
              let parent = document.querySelector("#main-form");
              let form_group = parent.querySelector(" .form-group");
              p = document.createElement("p");
              p.classList.add("message");
              p.innerHTML = data["message"];
              parent.insertBefore(p, form_group);
            } else {
              p.innerHTML = data["message"];
            }
          } else if (data.status) {
            message(data.location);
          } else if (data.error) {
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

let lisitng_page = document.querySelector("[data-id]");

if (lisitng_page && lisitng_page.getAttribute("data-id") == "listing_page") {
  let button = lisitng_page.querySelector("button");
  button.addEventListener("click", (event) => {
    event.preventDefault();
    let input = lisitng_page.querySelector("input");

    if (input.value) {
      fetch(window.location.href, {
        method: "POST",
        body: JSON.stringify({ search_query: input.value }),
      })
        .then((res) => res.json())
        .then((data) => {
          window.location.href = `/review_listing/${data.location}/`;
        })
        .catch((err) => console.log(err));
    }
  });
}

function add_comment(curr, id) {
  let parent = curr.closest("div");
  let textarea = parent.querySelector("textarea");
  if (textarea.value) {
    fetch(window.location.href, {
      method: "POST",
      body: JSON.stringify({ comment: textarea.value, review_id: id }),
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.status) {
          textarea.value = "";
          location.reload();
        } else {
          if (data.logged) {
            console.log("login first");
          }
        }
      })
      .catch((err) => console.log(err));
  } else {
    textarea.style.border = "2px solid red";
    textarea.placeholder = "Please fill the field";
  }
}

let login = document.querySelector(".pop_login");
if (login) {
  document.querySelector(".user_left").addEventListener("click", () => {
    document.querySelector(".pop_login").style.display = "block";
  });
}
function get(uri) {
  location.href = `/${uri}/`;
}

function hiddenpopup(name, evt) {
  evt.preventDefault();
  let emiter = evt.currentTarget.closest(".popup");
  if (emiter) {
    emiter.style.display = "None";
  }

  let popup_btn = document.querySelector(`.${name}-popup`);
  if (popup_btn) {
    popup_btn.style.display = "block";
    document.querySelector(".popup-box").classList.add("active");
  }
}
// let login_popup = document.querySelector(".login-popup");
// if (login_popup) {
//   document.querySelector(".login_btn").addEventListener("click", (event) => {
//     event.preventDefault();
//     login_popup.style.display = "flex";
//   });
// }
// let register_popup = document.querySelector(".register-popup");
// if (register_popup) {
//   document.querySelector(".register_btn").addEventListener("click", (event) => {
//     event.preventDefault();
//     register_popup.style.display = "flex";
//   });
// }
// let forget_popup = document.querySelector(".forget-popup");
// if (forget_popup) {
//   let btn = document.querySelector(".forget_btn");
//   btn.addEventListener("click", (event) => {
//     event.preventDefault();
//     cross_btn(btn);
//     forget_popup.style.display = "flex";
//   });
// }
function cross_btn(curr) {
  curr.closest(".popup").style.display = "None";
  document.querySelector(".popup-box").classList.remove("active");
}

let popup = document.querySelectorAll(".popup");
if (popup) {
  popup.forEach((pop) => {
    btn = pop.querySelector('button[type="submit"]');
    if (btn) {
      console.log(btn);
      btn.addEventListener("click", (event) => {
        event.preventDefault();
        console.log(event.currentTarget);
        let formData = new FormData(pop.querySelector("form"));
        formData.append("type", pop.getAttribute("data-popup"));
        fetch("/" + pop.getAttribute("data-popup") + "/", {
          method: "POST",
          body: formData,
        })
          .then((res) => res.json())
          .then((data) => {
            if (data.status) {
              message(data.location);
            } else if (data.error) {
              let err = data.error;
              if (err["invalid"]) {
                let parent = document.querySelector(".popup form");
                let p = document.querySelector(".popup form > .err_msg");
                if (p == null) {
                  let form_group = document.querySelector("form .form-group");
                  p = document.createElement("p");
                  p.classList.add("err_msg");
                  p.style.textAlign = "center";
                  p.innerHTML = err["invalid"];
                  parent.insertBefore(p, form_group);
                } else {
                  p.innerHTML = err["invalid"];
                }
              } else {
                invalid_err = document.querySelector("#login-form p");
                if (invalid_err) {
                  invalid_err.remove();
                }
              }

              pop.querySelectorAll("input,textarea,select").forEach((input) => {
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
                    p.classList.add("err_msg");
                    p.innerHTML = err[input.name];
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
          });
      });
    }
  });
}

function message(location) {
  document.querySelector(".message").style.display = "flex";
  setTimeout(() => {
    window.location.reload(3);
    //window.location.href = `/${location}/`;
  }, 2000);
}
