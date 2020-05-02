<div style=" ">
    <div class="float-left">
        <p>
            <a href="/crud/inc/index.php?task=report">All Student</a>  
            <?php if(hasPrivilege()): ?>
            |
            <a href="/crud/inc/index.php?task=add">Add new Student</a> 
            <?php endif; ?>
            <?php 
            if(isAdmin()): ?>
            |
            <a href="/crud/inc/index.php?task=seed">Seed</a> 
           <?php
           endif;
           ?>
        </p>
    </div>
    <div class="float-right">
        <?php
        // $_SESSION['loggedin'] ='';
        if(!$_SESSION['loggedin']):
        ?>
        <a href="/crud/inc/auth.php">Log In</a>
        <?php
        else:
        ?>
        <a href="/crud/inc/auth.php?logout=true">Log Out(<?php echo $_SESSION['role'] ?>)</a>
        <?php
        endif;
        ?>
    </div>
    <p></p>
</div>