<script src = "./Javascript/logic.js"></script>

<div class="alert-box">
    <?php
        if(isset($_COOKIE["state"])) {
            echo "<span class='alert-close-btn'>&times;</span>";
        }
    ?>
    <?php echo $message ?>
</div>

<script>
    // JavaScript to close the alert box
    document.querySelector('.alert-close-btn').addEventListener('click', closeAlert);
</script>