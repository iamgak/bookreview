
<div class="popup-box">
<?php if(!USER::$logged){?>
<div class="login-popup popup" data-popup="login">
    <div class="close-button" onclick="cross_btn(this)">&times;</div>
    <form id="form" data-id='post_form'>
        <div class="title">Login</div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="text" name="password">
        </div>
        <div class="form-group">
            <button type="submit">Login ?</button>
        </div>
        <span>
            <a class="forget_btn" onclick="hiddenpopup('register',event)">Register? New User</a> |
            <a class="forget_btn" onclick="hiddenpopup('forget',event)">Forget Password?</a>

        </span>
    </form>
    <p class="instruction">Note:Enter registered email and password</p>

</div>

<div class="register-popup popup" data-popup="register">
    <div class="close-button" onclick="cross_btn(this)">&times;</div>
    <form id="form" data-id='post_form'>
        <div class="title">Register User</div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email">
        </div>

        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="text" name="password">
        </div>

        <div class="form-group">
            <label for="repeat_password">Repeat-Password:</label>
            <input type="text" id="repeat_password" name="repeat_password">
        </div>
        <div class="form-group">
            <button type="submit">Register ?</button>
        </div>
        <span>
            <a class="forget_btn" onclick="hiddenpopup('login',event)">Login? Already User</a> |
            <a class="forget_btn" onclick="hiddenpopup('forget',event)">Forget Password?</a>

        </span>

    </form>
    <p class="instruction">Note:You will recieve link on your email on your registered email</p>

</div>
<div class="forget-popup popup" data-popup="forget_password">
    <div class="close-button" onclick="cross_btn(this)">&times;</div>
    <form id="form" data-id='post_form'>
        <div class="title">Reset Password</div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email">
        </div>
        <div class="form-group">
            <button type="submit">Click to Send Link</button>
        </div>
        <span>
            <a class="forget_btn" onclick="hiddenpopup('login',event)">Login? Remember Password</a>

        </span>
    </form>
    <p class="instruction">Note:You will recieve link on your email if you input registered email</p>

</div>
<?php } ?>
<div class="message popup">
    <div class="close-button" onclick="cross_btn(this)">&times;</div>

    <div class="success-container">
        <div class="circle">
            <h1 class="success-text">Success</h1>
        </div>
    </div>

</div>
</div>
<header>
  <ul class="navbar">
    <li><a class="active" href="/"><?php echo website; ?></a></li>
    <li><a href="/listing/">Listing</a></li>
    <li><a href="/review_listing/">Review</a></li>
    <li><a href="/contact_us/">Contact</a></li>
    
    <?php if(USER::$logged){?>
      <li class="rt logout_btn"><a href="/logout/">Logout</a></li>
      <li class="rt"><div class="drop-down-heading">
        <?php echo '@'.USER::$username; ?>

      </div>
        <ul class="drop-down-user">
          <li>user profile</li>
          <li>user profile</li>
          <li>user profile</li>
          <li>user profile</li>
        </ul>
      </li>

    <?php }else{ ?>
      <li class="rt login_btn" onclick="hiddenpopup('login',event)"><a href="/login/">Login</a></li>
    <li class="rt register_btn" onclick="hiddenpopup('register',event)"><a href="/register/">Register</a></li>
    <?php } ?>
  </ul>

</header>