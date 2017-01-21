<?php

// if the from is loaded from WordPress form loader plugin,
// the phpfmg_display_form() will be called by the loader
if( !defined('FormmailMakerFormLoader') ){
    # This block must be placed at the very top of page.
    # --------------------------------------------------
	require_once( dirname(__FILE__).'/form.lib.php' );
    phpfmg_display_form();
    # --------------------------------------------------
};


function phpfmg_form( $sErr = false ){
		$style=" class='form_text' ";

?>




<div id='frmFormMailContainer'>

<form name="frmFormMail" id="frmFormMail" target="submitToFrame" action='<?php echo PHPFMG_ADMIN_URL . '' ; ?>' method='post' enctype='multipart/form-data' onsubmit='return fmgHandler.onSubmit(this);'>

<input type='hidden' name='formmail_submit' value='Y'>
<input type='hidden' name='mod' value='ajax'>
<input type='hidden' name='func' value='submit'>

            
<ol class='phpfmg_form' >

<li class='field_block' id='field_0_div'><div class='col_label'>
	<label class='form_field'>Your name</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_0"  id="field_0" value="<?php  phpfmg_hsc("field_0", ""); ?>" class='text_box'>
	<div id='field_0_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_1_div'><div class='col_label'>
	<label class='form_field'>Email</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_1"  id="field_1" value="<?php  phpfmg_hsc("field_1", ""); ?>" class='text_box'>
	<div id='field_1_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_2_div'><div class='col_label'>
	<label class='form_field'>Country</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<?php phpfmg_dropdown( 'field_2', "Afghanistan|Aland Islands|Albania|Algeria|American Samoa|Andorra|Angola|Anguilla|Antarctica|Antigua and Barbuda|Argentina|Armenia|Aruba|Australia|Austria|Azerbaijan|Bahamas|Bahrain|Bangladesh|Barbados|Belarus|Belgium|Belize|Benin|Bermuda|Bhutan|Bolivia|Bosnia and Herzegovina|Botswana|Bouvet Island|Brazil|British Indian Ocean Territory|British Virgin Islands|Brunei|Bulgaria|Burkina Faso|Burundi|Cambodia|Cameroon|Canada|Cape Verde|Cayman Islands|Central African Republic|Chad|Chile|China|Christmas Island|Cocos (Keeling) Islands|Colombia|Comoros|Congo|Cook Islands|Costa Rica|Croatia|Cuba|Cyprus|Czech Republic|Democratic Republic of Congo|Denmark|Disputed Territory|Djibouti|Dominica|Dominican Republic|East Timor|Ecuador|Egypt|El Salvador|Equatorial Guinea|Eritrea|Estonia|Ethiopia|Falkland Islands|Faroe Islands|Federated States of Micronesia|Fiji|Finland|France|French Guyana|French Polynesia|French Southern Territories|Gabon|Gambia|Georgia|Germany|Ghana|Gibraltar|Greece|Greenland|Grenada|Guadeloupe|Guam|Guatemala|Guinea|Guinea-Bissau|Guyana|Haiti|Heard Island and Mcdonald Islands|Honduras|Hong Kong|Hungary|Iceland|India|Indonesia|Iran|Iraq|Iraq-Saudi Arabia Neutral Zone|Ireland|Israel|Italy|Ivory Coast|Jamaica|Japan|Jordan|Kazakhstan|Kenya|Kiribati|Kuwait|Kyrgyzstan|Laos|Latvia|Lebanon|Lesotho|Liberia|Libya|Liechtenstein|Lithuania|Luxembourg|Macau|Macedonia|Madagascar|Malawi|Malaysia|Maldives|Mali|Malta|Marshall Islands|Martinique|Mauritania|Mauritius|Mayotte|Mexico|Moldova|Monaco|Mongolia|Montenegro|Montserrat|Morocco|Mozambique|Myanmar|Namibia|Nauru|Nepal|Netherlands Antilles|Netherlands|New Caledonia|New Zealand|Nicaragua|Niger|Nigeria|Niue|Norfolk Island|North Korea|Northern Mariana Islands|Norway|Oman|Pakistan|Palau|Palestinian Occupied Territories|Panama|Papua New Guinea|Paraguay|Peru|Philippines|Pitcairn Islands|Poland|Portugal|Puerto Rico|Qatar|Reunion|Romania|Russia|Rwanda|Saint Helena and Dependencies|Saint Kitts and Nevis|Saint Lucia|Saint Pierre and Miquelon|Saint Vincent and the Grenadines|Samoa|San Marino|Sao Tome and Principe|Saudi Arabia|Select One|Senegal|Serbia|Seychelles|Sierra Leone|Singapore|Slovakia|Slovenia|Solomon Islands|Somalia|South Africa|South Georgia and South Sandwich Islands|South Korea|Spain|Spratly Islands|Sri Lanka|Sudan|Suriname|Svalbard and Jan Mayen|Swaziland|Sweden|Switzerland|Syria|Taiwan|Tajikistan|Tanzania|Thailand|Togo|Tokelau|Tonga|Trinidad and Tobago|Tunisia|Turkey|Turkmenistan|Turks And Caicos Islands|Tuvalu|US Virgin Islands|Uganda|Ukraine|United Arab Emirates|United Kingdom|United Nations Neutral Zone|United States Minor Outlying Islands|United States|Uruguay|Uzbekistan|Vanuatu|Vatican City|Venezuela|Vietnam|Wallis and Futuna|Western Sahara|Yemen|Zambia|Zimbabwe" );?>
	<div id='field_2_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_3_div'><div class='col_label'>
	<label class='form_field'>Satisfaction</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<?php phpfmg_checkboxes( 'field_3', "Very Satisfied|Satisfied|Neutral|Unsatisfied|Very Unsatisfied|N/A" );?>
	<div id='field_3_tip' class='instruction'></div>
	</div>
</li>

<li class='field_block' id='field_4_div'><div class='col_label'>
	<label class='form_field'>Message</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<textarea name="field_4" id="field_4" rows=4 cols=25 class='text_area'><?php  phpfmg_hsc("field_4"); ?></textarea>

	<div id='field_4_tip' class='instruction'></div>
	</div>
</li>


<li class='field_block' id='phpfmg_captcha_div'>
	<div class='col_label'><label class='form_field'>Security Code:</label> <label class='form_required' >*</label> </div><div class='col_field'>
	<?php phpfmg_show_captcha(); ?>
	</div>
</li>


            <li>
            <div class='col_label'>&nbsp;</div>
            <div class='form_submit_block col_field'>
	

                <input type='submit' value='Submit' class='form_button'>

				<div id='err_required' class="form_error" style='display:none;'>
				    <label class='form_error_title'>Please check the required fields</label>
				</div>
				


                <span id='phpfmg_processing' style='display:none;'>
                    <img id='phpfmg_processing_gif' src='<?php echo PHPFMG_ADMIN_URL . '?mod=image&amp;func=processing' ;?>' border=0 alt='Processing...'> <label id='phpfmg_processing_dots'></label>
                </span>
            </div>
            </li>

</ol>
</form>

<iframe name="submitToFrame" id="submitToFrame" src="javascript:false" style="position:absolute;top:-10000px;left:-10000px;" /></iframe>

</div>
<!-- end of form container -->


<!-- [Your confirmation message goes here] -->
<div id='thank_you_msg' style='display:none;'>
Your Message has been sent. Thank you!
</div>


            






<?php

    phpfmg_javascript($sErr);

}
# end of form




function phpfmg_form_css(){
    $formOnly = isset($GLOBALS['formOnly']) && true === $GLOBALS['formOnly'];
?>
<style type='text/css'>
<?php 
if( !$formOnly ){
    echo"
body{
    margin-left: 18px;
    margin-top: 18px;
}

body{
    font-family : Verdana, Arial, Helvetica, sans-serif;
    font-size : 13px;
    color : #474747;
    background-color: transparent;
}

select, option{
    font-size:13px;
}
";
}; // if
?>

ol.phpfmg_form{
    list-style-type:none;
    padding:0px;
    margin:0px;
}

ol.phpfmg_form input, ol.phpfmg_form textarea, ol.phpfmg_form select{
    border: 1px solid #ccc;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
}

ol.phpfmg_form li{
    margin-bottom:5px;
    clear:both;
    display:block;
    overflow:hidden;
	width: 100%
}


.form_field, .form_required{
    font-weight : bold;
}

.form_required{
    color:red;
    margin-right:8px;
}

.field_block_over{
}

.form_submit_block{
    padding-top: 3px;
}

.text_box,.text_select {
    height: 32px;
}

.text_box, .text_area, .text_select {
    min-width:160px;
    max-width:300px;
    width: 100%;
    margin-bottom: 10px;
}

.text_area{
    height:80px;
}

.form_error_title{
    font-weight: bold;
    color: red;
}

.form_error{
    background-color: #F4F6E5;
    border: 1px dashed #ff0000;
    padding: 10px;
    margin-bottom: 10px;
}

.form_error_highlight{
    background-color: #F4F6E5;
    border-bottom: 1px dashed #ff0000;
}

div.instruction_error{
    color: red;
    font-weight:bold;
}

hr.sectionbreak{
    height:1px;
    color: #ccc;
}

#one_entry_msg{
    background-color: #F4F6E5;
    border: 1px dashed #ff0000;
    padding: 10px;
    margin-bottom: 10px;
}


#frmFormMailContainer input[type="submit"]{
    padding: 10px 25px; 
    font-weight: bold;
    margin-bottom: 10px;
    background-color: #FAFBFC;
}

#frmFormMailContainer input[type="submit"]:hover{
    background-color: #E4F0F8;
}

<?php phpfmg_text_align();?>    



</style>

<?php
}
# end of css
 
# By: formmail-maker.com
?>