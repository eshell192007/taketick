<script>
    window.config = {
        i18n: {
            'Name': '<?php echo _('Name') ?>',
            'Color': '<?php echo _('Color') ?>',
            'Save': '<?php echo _('Save') ?>',
            'Priority': '<?php echo _('Priority') ?>',
        }
    };
    var bottoms = document.querySelectorAll('.scrollbar-bottom');
    for(var i in bottoms) {
        if(bottoms.hasOwnProperty(i)) {
            bottoms[i].scrollTop = Math.pow(10, 10);
        }
    }
</script>