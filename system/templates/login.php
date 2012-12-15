        <body>
        <div id="wrap" class="container_12 wrapper">
            <div id="menu" class="grid_6">
               <?php pf_core::loadTemplate('menu'); ?>
            </div>
            <div id="login" class="" style="padding-top:100px;">
                <form id="login" action="<?php echo pf_config::get('base_url').pf_config::get('index_page')?>/login/action" method="POST">
                    
                    <label for="username">
                        Username:
                        <input type="text" name="username" placeholder="Username" required/>
                    </label>
                    <label for="password">
                        Password:
                        <input type="password" name="password" placeholder="Password" required />
                    </label>
                    <input class="button" type="submit" value="Login"/>
                </form>
            </div>

        </div>
        <div class="footer center">
            <?php pf_core::loadTemplate('footer'); ?>
        </div>
    </body>
