<h1>Connection</h1>
<div class="text-danger">
    <?php if (isset($error_login)): ?>
    <p class="error"><?= $error_login; ?>
        <?php endif ?>
</div>

<form method="post">
    <div>
        <input type="text" name="username"  placeholder="username" required="true">
    </div>
    <div>
        <input type="password" name="passwd" placeholder="password" required="true">
    </div>
    <div>
        <input type="submit" name="login" value="Connection">
    </div>
</form>


<h2>Subscribe</h2>
<div>
    <?php if (isset($error_subscribe)): ?>
    <p class="error"><?= $error_subscribe; ?>
        <?php endif ?>
</div>

<form method="post">
    <div>
        <input type="text" name="username" placeholder="username" required="true">
    </div>
    <div>
        <input type="email" name="email" placeholder="email" required="true">
    </div>
    <div>
        <input type="password" name="passwd" placeholder="password"required="true">
    </div>
    <div>
        <input type="password" name="passwd2" placeholder="comfirm password" required="true">
    </div>
    <div>
        <input type="submit" name="subscribe" value="Subscribe">
    </div>
</form>