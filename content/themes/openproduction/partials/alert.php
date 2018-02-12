<script>
    $(document).ready(function () {
        notie.alert(<?php echo @$type ? @$type : '1'; ?>, '<?php echo @$message; ?>', 6);
    });

</script>
<div class="notie-container" id="notie-container"></div>

