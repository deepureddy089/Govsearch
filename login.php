<?php include 'header.php'; ?>

<div class="container-fluid d-flex flex-column justify-content-between" style="height: 90vh; padding: 0;">
    <div class="d-flex justify-content-center align-items-center flex-grow-1">
        <div class="login-box" style="width: 100%; max-width: 400px; padding: 30px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
            <h2 class="text-center" style="color: #000000;">Admin Login</h2>

            <form action="login_handler.php" method="POST">
                <div class="form-group">
                    <label for="username" style="color: #000000;">Username/Email</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username or email" required style="background-color: #ffffff; color: #000000; border: 2px solid #000000; border-radius: 4px;">
                </div>
                <div class="form-group">
                    <label for="password" style="color: #000000;">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required style="background-color: #ffffff; color: #000000; border: 2px solid #000000; border-radius: 4px;">
                </div>
                <!-- Login Button with black background and hover effect -->
                <button type="submit" class="btn search-button btn-block" style="border-radius: 30px; border: none; background-color: #000000; color: #ffffff; padding: 12px; transition: 0.3s;" onmouseover="this.style.backgroundColor='#ffffff'; this.style.color='#000000'" onmouseout="this.style.backgroundColor='#000000'; this.style.color='#ffffff'">Login</button>
            </form>
        </div>
    </div>
    <!-- Footer -->
    <?php include 'footer.php'; ?>
</div>