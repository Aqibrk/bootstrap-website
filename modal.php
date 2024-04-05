<div id="userModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">User Actions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="user-actions">
                    <?php if(isset($_SESSION["email"])){ ?>
                        <a href="admin/logout.php" class="btn btn-danger btn-block">Logout</a> 
                        <a href="" class="btn btn-info btn-block"><b>Name:</b> <?php echo $_SESSION['user_first_name'].' '.$_SESSION['user_last_name']; ?></a>
                        <a href="" class="btn btn-secondary btn-block"><b>Email:</b> <?php echo $_SESSION['email']; ?></a> 
                        <a href="profile.php?id=<?php echo $_SESSION['id']; ?>" class="btn btn-secondary btn-block"><b>User Profile</b> <?php echo $_SESSION['id']; ?> </a> 
                    <?php }else{ ?>
                        <a href="admin/index.php" class="btn btn-primary btn-block">Login</a>
                        <a href="admin/register.php" class="btn btn-secondary btn-block">Register</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
