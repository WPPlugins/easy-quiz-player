<body class="mod-welcome con-index act-index bc-lang-en">
<header class="container">

    <div class="header_title"> <h3 class="pull-left">+ Create quizzes with your own questions</h3> </div> <br/>
    <div class="header_title"> <h3 class="pull-left">+ Five different question types</h3> </div> <br/>
    <div class="header_title"> <h3 class="pull-left">+ Quick and easy administration</h3></div>

    <div class="pull-right login-top">
        <a class="brand pull-right" href="/en">
            <img src="../wp-content/plugins/easy-quiz-player/images/eqp-logo.png">
        </a>
        <div class="clear-both">
            <p>
                <a style="width: 90px; margin-top: 50px;" class="btn btn-eqp btn-get-started pull-right" href="<?php echo $GLOBALS['EasyQuizPlayerServer']; ?>/account/login" target="_blank">Login</a>
            </p>
        </div>
    </div>
</header>
<div class="content container">
    <div class="row">
        <div class="span7 quiz-preview">
            <script id="mm-script-57759524050" type="text/javascript" src="http://quiz.easyquizplayer.com/js/quizplayer/embed.js?quiz=1009&language=en&size=medium&script=mm-script-57759524050&design=1&width=600&height=427" charset="utf-8"></script>
        </div>
        <div class="span4 pull-right">
            <h3>CREATE A FREE ACCOUNT</h3>


            <form id="frmregister" name="frmregister" class="form-horizontal" enctype="multipart/form-data"
                  method="post" action="<?php echo $GLOBALS['EasyQuizPlayerServer']; ?>/en/account/details/edit">
                <fieldset>
                    <div class="control-group fld-first_name">
                        <div class="controls">
                            <input type="text" name="first_name" id="first_name" value="" placeholder="First Name:">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="control-group fld-family_name">
                        <div class="controls">
                            <input type="text" name="family_name" id="family_name" value="" placeholder="Family Name:">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="control-group fld-email">
                        <div class="controls">
                            <input type="text" name="email" id="email" value="" placeholder="E-mail">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="control-group fld-confirm_email">
                        <div class="controls">
                            <input type="text" name="confirm_email" id="confirm_email" value=""
                                   placeholder="Confirm Email:" autocomplete="off">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="control-group fld-password">
                        <div class="controls">
                            <input type="password" name="password" id="password" value="" placeholder="Password:">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="control-group fld-confirm_password">
                        <div class="controls">
                            <input type="password" name="confirm_password" id="confirm_password" value=""
                                   placeholder="Confirm Password:">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="control-group fld-disclaimer_accepted">
                        <div class="controls">
                            <label class="checkbox" id="disclaimer_accepted-label"  for="disclaimer_accepted">
                                 <input type="checkbox"
                                                                                                 name="disclaimer_accepted"
                                                                                                 id="disclaimer_accepted"
                                                                                                 value="1"
                                                                                                 data:url="<?php echo $GLOBALS['EasyQuizPlayerServer']; ?>/en/index/index/terms-conditions">
                                By clicking Create Account, you agree to our <a
                                    href="<?php echo $GLOBALS['EasyQuizPlayerServer']; ?>/en/index/index/terms-conditions" id="term_link"
                                    target="_blank">Terms</a></label>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-actions">
                        <input type="hidden" name="eqp-plugin" value="<?php echo rand(); ?>" />
                        <input type="submit" name="register" id="register" value="Create Account"
                               class="btn btn-primary btn btn-primary btn btn-eqp">

                </fieldset>
            </form>
        </div>
    </div>
    <div class="modal fade bc-global-modal-form">
        <div class="modal-header">
            <a data-dismiss="modal" class="close" href="#">×</a>
            <h3><span></span></h3>
        </div>
        <div class="modal-body"></div>
        <div class="modal-footer">
            <button class="btn btn-primary btn-submit" data-loading-text="Delete">
                Delete</button>
            <button class="btn" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
<footer class="footer container">
    <p class="pull-left">
        © Copyright 2015    </p>
</footer>
<div id="loading" class="modal no-border">
</div>
</body>

<!--</html>-->


<script>
    jQuery(document).ready(function($){
        jQuery( "#frmregister" ).on( "submit", function( event ) {
            jQuery('.help-block').text('');
            jQuery( this).find('input[type="text"]').css('border-color','#333333');
            jQuery( this).find('input[type="password"]').css('border-color','#333333');
            var oCreateAccount = $( this ).serializeArray();
            var urlPostAccount =  jQuery(this).attr('action');
            var checkForm = validateForm(oCreateAccount);

            return checkForm;

        });

        function validateForm(oCreateAccount)
        {
            var email = '';
            var password = '';
            var status = true;
            jQuery('.fld-disclaimer_accepted').find('.help-block').text("Value is required and can't be empty");
            jQuery.each(oCreateAccount,function(index , value) {

                if (value.name != 'disclaimer_accepted' && value.value == '') {
                    jQuery('.fld-' + value.name).find('.help-block').text("Value is required and can't be empty");
                    jQuery('.fld-' + value.name).find('input').css('border-color','#b94a48');
                    status = false;
                }
                if (value.name == 'disclaimer_accepted' && value.value == '1') {
                    jQuery('.fld-' + value.name).find('.help-block').text("");

                }


                if (value.name == 'email' && validateEmail(value.value) && value.value != '') {
                    email = value.value;

                }
                if (value.name == 'confirm_email' && validateEmail(value.value) && value.value != '' && email != value.value) {

                    jQuery('.fld-' + value.name).find('.help-block').text("Email is not match");
                    status = false;
                }
                if (value.name == 'password' && value.value != '') {
                    password = value.value;
                }
                if (value.name == 'confirm_password' && value.value != '' && password != '' && password != value.value) {
                    jQuery('.fld-' + value.name).find('.help-block').text("Password is not match");
                    status = false;
                }

            });
            if(jQuery('.fld-disclaimer_accepted').find('.help-block').text() != '')
            {
                status = false;
            }
            return status;
        }

        function validateEmail(email) {
            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }
    });
</script>



