<script>
    // Fix modal speaker in some themes
    jQuery( ".mec-speaker-avatar a" ).click(function(e)
    {
        e.preventDefault();
        var id =  jQuery(this).attr('href');
        lity(id);
    });

    // Fix modal booking in some themes
    jQuery( ".mec-booking-button.mec-booking-data-lity" ).click(function(e)
    {
        e.preventDefault();
        var book_id =  jQuery(this).attr('href');
        lity(book_id);
    });
</script>