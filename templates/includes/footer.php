
          


        </div>
      </div>


                <?php
                
                if(hasAdmin()) : ?>

<p class="text-center"><a href="admin.php">Admin Control Panel</a></p>

            <?php endif; ?>

                  <?php
                if(countmod(getUser()['user_id'])>0) : ?>

<p class="text-center"><a href="mod_approve.php">Mod Control Panel</a></p>

            <?php endif; ?> 

   
  </body>
</html>
