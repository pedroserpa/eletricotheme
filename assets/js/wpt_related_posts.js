jQuery(document).ready(function(){
    jQuery('.wpt_related_posts input').change(function(event) {
        event.preventDefault();
        var rel_checkbox = event.target;
        if (rel_checkbox.checked) {
            console.log('checked');
        } else {
            console.log('unchecked');
        }
    });
});