<script>
    $(document).ready(function() {
        const checkPage = () => {
            if ($('.dd').attr('aria-expanded') == 'true') {
                $('.dd').find('i').css('transform', 'rotate(180deg)');
            } else {
                $('.dd').find('i').css('transform', 'rotate(0deg)');
            }
        }
        checkPage();
        $('.dd').click(function() {
            $('.dd').find('i').css('transition', '0.5s');
            checkPage();
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>