</div>
</div>
<!-- /#page-content-wrapper -->
</div>
<!-- toaster start -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast text-bg-info" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body">
            <?= $_SESSION['toaster'] ?>
        </div>
    </div>
</div>
<!-- toaster ends -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<?php
if (isset($_SESSION['toaster'])) toaster_message();
?>
</body>

</html>