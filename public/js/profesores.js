<script>
    $('.row_show').on('click', function() {
        id = $(this).attr('id').split('_'),
        id = id[1],
        $("#horario").load('index.php?ACTION=profesores&profesor=' + id)
    });
</script>