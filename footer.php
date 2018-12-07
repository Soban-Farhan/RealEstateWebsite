      </div>
      <div class="footer">
        <?php  display_Copyright()?>
        <br/>
        <a href="http://validator.w3.org/check?uri=referer">
          <img 	style="width:88px;
                height:31px;"
              src="http://www.w3.org/Icons/valid-xhtml10"
              alt="Valid XHTML 1.0 Strict" />
        </a>
            <a href="http://jigsaw.w3.org/css-validator/check/referer">
                <img 	style="width:88px;
                  height:31px;"
                      src="http://jigsaw.w3.org/css-validator/images/vcss"
                alt="Valid CSS!" />
          </a>
          <br/>
          <a href = "./privacy-policy.php"> Privacy Policy </a> <a href = "./aup.php"> Acceptable Use Policy </a>
      </div>

      <script>

      $("nav div").click(function() {
            $("ul").slideToggle();
            $("ul ul").css("display", "none");
      });
      $("ul li").click(function() {
            $("ul ul").slideUp();
            $(this).find('ul').slideToggle();
      });
      $(window).resize(function() {
            if($(window).width() > 768) {
                  $("ul").removeAttr('style');
            }
      });
      </script>

</body>
</html>
