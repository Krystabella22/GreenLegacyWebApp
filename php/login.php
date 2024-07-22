<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenLegacy | Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <header class="header">
        <div class="header-content">
            <div class="logo">Green Legacy</div>
            <div class="nav-buttons">
                <button class="nav-btn" onclick="window.location.href='index.html'">Plant a Tree</button>
                <button class="nav-btn" onclick="window.location.href='login.html'">Log in</button>
            </div>
        </div>
    </header>

    <div class="form-container">
        <div class="form-col">
            <div class="btn-box">
                <button type="button" class="btn btn-1" id="login">Login</button>
                <button type="button" class="btn btn-2" id="register">Register</button>
            </div>

            <!-- Login Form Container -->
            <form class="form-box login-form">
                <div class="form-title">
                    <span>Login</span>
                </div>
                <div class="form-inputs">
                    <div class="input-box">
                        <input type="text" class="inputs input-field" placeholder="Username" required>
                        <ion-icon name="person-outline" class="icon"></ion-icon>
                    </div>
                    <div class="input-box">
                        <input type="password" class="inputs input-field" placeholder="Password" required>
                        <ion-icon name="lock-closed-outline" class="icon"></ion-icon>
                    </div>
                </div>
                <div class="forgot-pass">
                    <a href="#">Forgot Password?</a>
                </div>
                <div class="input-box">
                    <button type="submit" class="inputs submit-btn" onclick="handleSubmit(event)">
                        <span>Login</span>
                        <ion-icon name="arrow-forward-outline" class="arrow forward icon"></ion-icon>
                    </button>
                </div>
                </div>
            </form>

            <!-- Placeholder for side picture -->
            <div class="side-picture">
                <img src="assets/images/rainforest.png" alt="Side Picture">
            </div>

                        <!-- Register Form Container-->
                         <!-- Change made: Add style to hide the register form initially -->
                        <form class="form-box register-form" id="register-form" style="display: none;">
                             <div class="form-title">
                                <span>Register</span>
                              </div>
                            <div class="form-inputs">
                                <div class="input-box">
                                    <input type="text" class="inputs input-field" placeholder="Email" required>
                                    <ion-icon name="mail-outline" class="icon"></ion-icon>
                                </div>
                                <div class="input-box">
                                    <input type="text" class="inputs input-field" placeholder="Username" required>
                                    <ion-icon name="person-outline" class="icon"></ion-icon>
                                </div>
                                <div class="input-box">
                                    <input type="password" class="inputs input-field" placeholder="Password" required>
                                    <ion-icon name="lock-closed-outline" class="icon"></ion-icon>
                                </div>
                            </div>
                            <div class="remember-me">
                                <input type="checkbox" id="remember-me-check">
                                <label for="remember-me-check">Remember Me</label>
                            </div>
                            <div class="input-box">
                                <button type="submit" class="inputs submit-btn" onclick="handleSubmit(event)">
                                    <span>Register</span>
                                    <ion-icon name="arrow-forward-outline" class="arrow forward icon"></ion-icon>
                                </button>
                            </div>
                            </div>
                        </form>
        </div> 
    </div>

    <script src="js/login.js"></script>
    <!-- Web Icons Import -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
