
 
<footer class="footer pt-5">
      <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
          
          <div class="col-lg-12">
            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
            
              <li class="nav-item">
                <a href="#" class="nav-link pe-0 text-muted" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link pe-0 text-muted" target="_blank">Services</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link pe-0 text-muted" target="_blank">Contact Us</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link pe-0 text-muted" target="_blank">User View</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>

</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js">
<script src="./assets/js/bootstrap.bundle.min.js"></script>
<script src="./assets/js/perfect-scrollbar.min.js"></script>
<script src="./assets/js/smooth-scrollbar.min.js"></script>
<script src="./assets/js/custom.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- alertify js -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>

<script>
  // $_SESSION['message'] = "Your custom success message!";
<?php if (isset($_SESSION['message'])) { ?>
    alertify.set('notifier', 'position', 'top-right');
    alertify.success('<?= $_SESSION['message'] ?>');
    <?php unset($_SESSION['message']); // Clear the message after displaying it ?>
<?php } ?>
</script>
</body>
</html>