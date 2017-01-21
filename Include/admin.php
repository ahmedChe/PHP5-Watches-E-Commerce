<?php
require_once( dirname(__FILE__).'/form.lib.php' );

define( 'PHPFMG_USER', "il-pazzo@hotmail.fr" ); // must be a email address. for sending password to you.
define( 'PHPFMG_PW', "ddc24d" );

?>
<?php
/**
 * GNU Library or Lesser General Public License version 2.0 (LGPLv2)
*/

# main
# ------------------------------------------------------
error_reporting( E_ERROR ) ;
phpfmg_admin_main();
# ------------------------------------------------------




function phpfmg_admin_main(){
    $mod  = isset($_REQUEST['mod'])  ? $_REQUEST['mod']  : '';
    $func = isset($_REQUEST['func']) ? $_REQUEST['func'] : '';
    $function = "phpfmg_{$mod}_{$func}";
    if( !function_exists($function) ){
        phpfmg_admin_default();
        exit;
    };

    // no login required modules
    $public_modules   = false !== strpos('|captcha|', "|{$mod}|", "|ajax|");
    $public_functions = false !== strpos('|phpfmg_ajax_submit||phpfmg_mail_request_password||phpfmg_filman_download||phpfmg_image_processing||phpfmg_dd_lookup|', "|{$function}|") ;   
    if( $public_modules || $public_functions ) { 
        $function();
        exit;
    };
    
    return phpfmg_user_isLogin() ? $function() : phpfmg_admin_default();
}

function phpfmg_ajax_submit(){
    $phpfmg_send = phpfmg_sendmail( $GLOBALS['form_mail'] );
    $isHideForm  = isset($phpfmg_send['isHideForm']) ? $phpfmg_send['isHideForm'] : false;

    $response = array(
        'ok' => $isHideForm,
        'error_fields' => isset($phpfmg_send['error']) ? $phpfmg_send['error']['fields'] : '',
        'OneEntry' => isset($GLOBALS['OneEntry']) ? $GLOBALS['OneEntry'] : '',
    );
    
    @header("Content-Type:text/html; charset=$charset");
    echo "<html><body><script>
    var response = " . json_encode( $response ) . ";
    try{
        parent.fmgHandler.onResponse( response );
    }catch(E){};
    \n\n";
    echo "\n\n</script></body></html>";

}


function phpfmg_admin_default(){
    if( phpfmg_user_login() ){
        phpfmg_admin_panel();
    };
}



function phpfmg_admin_panel()
{    
    phpfmg_admin_header();
    phpfmg_writable_check();
?>    
<table cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td valign=top style="padding-left:280px;">

<style type="text/css">
    .fmg_title{
        font-size: 16px;
        font-weight: bold;
        padding: 10px;
    }
    
    .fmg_sep{
        width:32px;
    }
    
    .fmg_text{
        line-height: 150%;
        vertical-align: top;
        padding-left:28px;
    }

</style>

<script type="text/javascript">
    function deleteAll(n){
        if( confirm("Are you sure you want to delete?" ) ){
            location.href = "admin.php?mod=log&func=delete&file=" + n ;
        };
        return false ;
    }
</script>


<div class="fmg_title">
    1. Email Traffics
</div>
<div class="fmg_text">
    <a href="admin.php?mod=log&func=view&file=1">view</a> &nbsp;&nbsp;
    <a href="admin.php?mod=log&func=download&file=1">download</a> &nbsp;&nbsp;
    <?php 
        if( file_exists(PHPFMG_EMAILS_LOGFILE) ){
            echo '<a href="#" onclick="return deleteAll(1);">delete all</a>';
        };
    ?>
</div>


<div class="fmg_title">
    2. Form Data
</div>
<div class="fmg_text">
    <a href="admin.php?mod=log&func=view&file=2">view</a> &nbsp;&nbsp;
    <a href="admin.php?mod=log&func=download&file=2">download</a> &nbsp;&nbsp;
    <?php 
        if( file_exists(PHPFMG_SAVE_FILE) ){
            echo '<a href="#" onclick="return deleteAll(2);">delete all</a>';
        };
    ?>
</div>

<div class="fmg_title">
    3. Form Generator
</div>
<div class="fmg_text">
    <a href="http://www.formmail-maker.com/generator.php" onclick="document.frmFormMail.submit(); return false;" title="<?php echo htmlspecialchars(PHPFMG_SUBJECT);?>">Edit Form</a> &nbsp;&nbsp;
    <a href="http://www.formmail-maker.com/generator.php" >New Form</a>
</div>
    <form name="frmFormMail" action='http://www.formmail-maker.com/generator.php' method='post' enctype='multipart/form-data'>
    <input type="hidden" name="uuid" value="<?php echo PHPFMG_ID; ?>">
    <input type="hidden" name="external_ini" value="<?php echo function_exists('phpfmg_formini') ?  phpfmg_formini() : ""; ?>">
    </form>

		</td>
	</tr>
</table>

<?php
    phpfmg_admin_footer();
}



function phpfmg_admin_header( $title = '' ){
    header( "Content-Type: text/html; charset=" . PHPFMG_CHARSET );
?>
<html>
<head>
    <title><?php echo '' == $title ? '' : $title . ' | ' ; ?>PHP FormMail Admin Panel </title>
    <meta name="keywords" content="PHP FormMail Generator, PHP HTML form, send html email with attachment, PHP web form,  Free Form, Form Builder, Form Creator, phpFormMailGen, Customized Web Forms, phpFormMailGenerator,formmail.php, formmail.pl, formMail Generator, ASP Formmail, ASP form, PHP Form, Generator, phpFormGen, phpFormGenerator, anti-spam, web hosting">
    <meta name="description" content="PHP formMail Generator - A tool to ceate ready-to-use web forms in a flash. Validating form with CAPTCHA security image, send html email with attachments, send auto response email copy, log email traffics, save and download form data in Excel. ">
    <meta name="generator" content="PHP Mail Form Generator, phpfmg.sourceforge.net">

    <style type='text/css'>
    body, td, label, div, span{
        font-family : Verdana, Arial, Helvetica, sans-serif;
        font-size : 12px;
    }
    </style>
</head>
<body  marginheight="0" marginwidth="0" leftmargin="0" topmargin="0">

<table cellspacing=0 cellpadding=0 border=0 width="100%">
    <td nowrap align=center style="background-color:#024e7b;padding:10px;font-size:18px;color:#ffffff;font-weight:bold;width:250px;" >
        Form Admin Panel
    </td>
    <td style="padding-left:30px;background-color:#86BC1B;width:100%;font-weight:bold;" >
        &nbsp;
<?php
    if( phpfmg_user_isLogin() ){
        echo '<a href="admin.php" style="color:#ffffff;">Main Menu</a> &nbsp;&nbsp;' ;
        echo '<a href="admin.php?mod=user&func=logout" style="color:#ffffff;">Logout</a>' ;
    }; 
?>
    </td>
</table>

<div style="padding-top:28px;">

<?php
    
}


function phpfmg_admin_footer(){
?>

</div>

<div style="color:#cccccc;text-decoration:none;padding:18px;font-weight:bold;">
	:: <a href="http://phpfmg.sourceforge.net" target="_blank" title="Free Mailform Maker: Create read-to-use Web Forms in a flash. Including validating form with CAPTCHA security image, send html email with attachments, send auto response email copy, log email traffics, save and download form data in Excel. " style="color:#cccccc;font-weight:bold;text-decoration:none;">PHP FormMail Generator</a> ::
</div>

</body>
</html>
<?php
}


function phpfmg_image_processing(){
    $img = new phpfmgImage();
    $img->out_processing_gif();
}


# phpfmg module : captcha
# ------------------------------------------------------
function phpfmg_captcha_get(){
    $img = new phpfmgImage();
    $img->out();
    //$_SESSION[PHPFMG_ID.'fmgCaptchCode'] = $img->text ;
    $_SESSION[ phpfmg_captcha_name() ] = $img->text ;
}



function phpfmg_captcha_generate_images(){
    for( $i = 0; $i < 50; $i ++ ){
        $file = "$i.png";
        $img = new phpfmgImage();
        $img->out($file);
        $data = base64_encode( file_get_contents($file) );
        echo "'{$img->text}' => '{$data}',\n" ;
        unlink( $file );
    };
}


function phpfmg_dd_lookup(){
    $paraOk = ( isset($_REQUEST['n']) && isset($_REQUEST['lookup']) && isset($_REQUEST['field_name']) );
    if( !$paraOk )
        return;
        
    $base64 = phpfmg_dependent_dropdown_data();
    $data = @unserialize( base64_decode($base64) );
    if( !is_array($data) ){
        return ;
    };
    
    
    foreach( $data as $field ){
        if( $field['name'] == $_REQUEST['field_name'] ){
            $nColumn = intval($_REQUEST['n']);
            $lookup  = $_REQUEST['lookup']; // $lookup is an array
            $dd      = new DependantDropdown(); 
            echo $dd->lookupFieldColumn( $field, $nColumn, $lookup );
            return;
        };
    };
    
    return;
}


function phpfmg_filman_download(){
    if( !isset($_REQUEST['filelink']) )
        return ;
        
    $info =  @unserialize(base64_decode($_REQUEST['filelink']));
    if( !isset($info['recordID']) ){
        return ;
    };
    
    $file = PHPFMG_SAVE_ATTACHMENTS_DIR . $info['recordID'] . '-' . $info['filename'];
    phpfmg_util_download( $file, $info['filename'] );
}


class phpfmgDataManager
{
    var $dataFile = '';
    var $columns = '';
    var $records = '';
    
    function phpfmgDataManager(){
        $this->dataFile = PHPFMG_SAVE_FILE; 
    }
    
    function parseFile(){
        $fp = @fopen($this->dataFile, 'rb');
        if( !$fp ) return false;
        
        $i = 0 ;
        $phpExitLine = 1; // first line is php code
        $colsLine = 2 ; // second line is column headers
        $this->columns = array();
        $this->records = array();
        $sep = chr(0x09);
        while( !feof($fp) ) { 
            $line = fgets($fp);
            $line = trim($line);
            if( empty($line) ) continue;
            $line = $this->line2display($line);
            $i ++ ;
            switch( $i ){
                case $phpExitLine:
                    continue;
                    break;
                case $colsLine :
                    $this->columns = explode($sep,$line);
                    break;
                default:
                    $this->records[] = explode( $sep, phpfmg_data2record( $line, false ) );
            };
        }; 
        fclose ($fp);
    }
    
    function displayRecords(){
        $this->parseFile();
        echo "<table border=1 style='width=95%;border-collapse: collapse;border-color:#cccccc;' >";
        echo "<tr><td>&nbsp;</td><td><b>" . join( "</b></td><td>&nbsp;<b>", $this->columns ) . "</b></td></tr>\n";
        $i = 1;
        foreach( $this->records as $r ){
            echo "<tr><td align=right>{$i}&nbsp;</td><td>" . join( "</td><td>&nbsp;", $r ) . "</td></tr>\n";
            $i++;
        };
        echo "</table>\n";
    }
    
    function line2display( $line ){
        $line = str_replace( array('"' . chr(0x09) . '"', '""'),  array(chr(0x09),'"'),  $line );
        $line = substr( $line, 1, -1 ); // chop first " and last "
        return $line;
    }
    
}
# end of class



# ------------------------------------------------------
class phpfmgImage
{
    var $im = null;
    var $width = 73 ;
    var $height = 33 ;
    var $text = '' ; 
    var $line_distance = 8;
    var $text_len = 4 ;

    function phpfmgImage( $text = '', $len = 4 ){
        $this->text_len = $len ;
        $this->text = '' == $text ? $this->uniqid( $this->text_len ) : $text ;
        $this->text = strtoupper( substr( $this->text, 0, $this->text_len ) );
    }
    
    function create(){
        $this->im = imagecreate( $this->width, $this->height );
        $bgcolor   = imagecolorallocate($this->im, 255, 255, 255);
        $textcolor = imagecolorallocate($this->im, 0, 0, 0);
        $this->drawLines();
        imagestring($this->im, 5, 20, 9, $this->text, $textcolor);
    }
    
    function drawLines(){
        $linecolor = imagecolorallocate($this->im, 210, 210, 210);
    
        //vertical lines
        for($x = 0; $x < $this->width; $x += $this->line_distance) {
          imageline($this->im, $x, 0, $x, $this->height, $linecolor);
        };
    
        //horizontal lines
        for($y = 0; $y < $this->height; $y += $this->line_distance) {
          imageline($this->im, 0, $y, $this->width, $y, $linecolor);
        };
    }
    
    function out( $filename = '' ){
        if( function_exists('imageline') ){
            $this->create();
            if( '' == $filename ) header("Content-type: image/png");
            ( '' == $filename ) ? imagepng( $this->im ) : imagepng( $this->im, $filename );
            imagedestroy( $this->im ); 
        }else{
            $this->out_predefined_image(); 
        };
    }

    function uniqid( $len = 0 ){
        $md5 = md5( uniqid(rand()) );
        return $len > 0 ? substr($md5,0,$len) : $md5 ;
    }
    
    function out_predefined_image(){
        header("Content-type: image/png");
        $data = $this->getImage(); 
        echo base64_decode($data);
    }
    
    // Use predefined captcha random images if web server doens't have GD graphics library installed  
    function getImage(){
        $images = array(
			'617F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7WAMYAlhDA0NDkMREpjAGMDQEOiCrC2hhxRRrYAhgaHSEiYGdFBm1KmrV0pWhWUjuC5kCVDeFEVVvK1AsAFOM0QFVTASol7UBVYwV6GJ0sYEKPypCLO4DAAVYx7VkBllrAAAAAElFTkSuQmCC',
			'4328' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdUlEQVR4nGNYhQEaGAYTpI37prCGMIQyTHVAFgsRaWV0dAgIQBJjDGFodG0IdBBBEmOdwtDK0BAAUwd20rRpq8JWrcyamoXkvgCQulYGFPNCQxkaHaYwopjHMAUoFoAuBnSLA6pekJtZQwNQ3TxQ4Uc9iMV9AD+6y31erTRZAAAAAElFTkSuQmCC',
			'48D0' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZUlEQVR4nGNYhQEaGAYTpI37pjCGsIYytKKIhbC2sjY6THVAEmMMEWl0bQgICEASY50CVNcQ6CCC5L5p01aGLV0VmTUNyX0BqOrAMDQUZB6qGMMUTDsYpmC6BaubByr8qAexuA8A57vM6/HN/akAAAAASUVORK5CYII=',
			'ED12' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZUlEQVR4nGNYhQEaGAYTpIn7QkNEQximMEx1QBILaBBpZQhhCAhAFWt0DGF0EEETc5jC0CCC5L7QqGkrs6atWhWF5D6oukYHTL2tDJhiUxjQ3TKFIQDdzYyhjqEhgyD8qAixuA8AaLrN/24DnMgAAAAASUVORK5CYII=',
			'2A71' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcElEQVR4nGNYhQEaGAYTpIn7WAMYAlhDA1qRxUSmMIYwNARMRRYLaGUFqgkIRdHdKtLo0OgA0wtx07RpK7OWrlqK4r4AoLopDCh2MDqIhjoEoIqxNog0OjqgiokAxVwbUMVCQ8FioQGDIPyoCLG4DwBUdcxm3G6UhAAAAABJRU5ErkJggg==',
			'DFAB' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYUlEQVR4nGNYhQEaGAYTpIn7QgNEQx2mMIY6IIkFTBFpYAhldAhAFmsVaWB0dHQQQRNjbQiEqQM7KWrp1LClqyJDs5Dch6YOIRYaiNU8ETS3oOsNDQCLobh5oMKPihCL+wD5A83OxRKEGAAAAABJRU5ErkJggg==',
			'585F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcElEQVR4nGNYhQEaGAYTpIn7QkMYQ1hDHUNDkMQCGlhbWRsYHRhQxEQaXdHEAgOA6qbCxcBOCpu2MmxpZmZoFrL7WllbgapR9DK0ijQ6oIkFtILsQBUTmcLayujoiCLGGsAYwhCK6paBCj8qQizuAwBtKcm/VvHB3wAAAABJRU5ErkJggg==',
			'EA3E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYElEQVR4nGNYhQEaGAYTpIn7QkMYAhhDGUMDkMQCGhhDWBsdHRhQxFhbGRoC0cREGh0Q6sBOCo2atjJr6srQLCT3oamDiomGOmAzD4uYK5re0BCRRkc0Nw9U+FERYnEfAK6bzOHBDt5AAAAAAElFTkSuQmCC',
			'D601' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXklEQVR4nGNYhQEaGAYTpIn7QgMYQximMLQiiwVMYW1lCGWYiiLWKtLI6OgQiibWwAokkd0XtXRa2FIgiey+gFbRViR1cPNcsYg5OjpgcwuKGNTNoQGDIPyoCLG4DwDKuM2WvL9zAgAAAABJRU5ErkJggg==',
			'BA62' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcklEQVR4nGNYhQEaGAYTpIn7QgMYAhhCGaY6IIkFTGEMYXR0CAhAFmtlbWVtcHQQQVEn0ugKpEWQ3BcaNW1l6tRVq6KQ3AdW5+jQiGJHq2ioK5BkQBEDmRcwhQHNDkegW1DdLNLoEMoYGjIIwo+KEIv7ANwUzpYVb/XgAAAAAElFTkSuQmCC',
			'93D2' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7WANYQ1hDGaY6IImJTBFpZW10CAhAEgtoZWh0bQh0EEEVa2VtCGgQQXLftKmrwpauigJChPtYXcHqGpHtYACbBzQBSUwAIjaFAYtbMN3MGBoyCMKPihCL+wBKDcz3MUgjXAAAAABJRU5ErkJggg==',
			'5C3F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYElEQVR4nGNYhQEaGAYTpIn7QkMYQ0EwBEksoIG10bXR0YEBRUykwaEhEEUsMECkgQGhDuyksGnTVq2aujI0C9l9rSjqEGJo5gW0YtohMgXTLawBYDejmjdA4UdFiMV9AHsSy1xq3eZoAAAAAElFTkSuQmCC',
			'360A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7RAMYQximMLQiiwVMYW1lCGWY6oCsslWkkdHRISAAWWyKSANrQ6CDCJL7VkZNC1u6KjJrGrL7poi2IqmDm+faEBgagibm6OiIog7iFkYUMYibUcUGKvyoCLG4DwDKtcr4ylXEgwAAAABJRU5ErkJggg==',
			'7A76' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcklEQVR4nGNYhQEaGAYTpIn7QkMZAlhDA6Y6IIu2MoYwNAQEBKCIsbYyNAQ6CCCLTRFpdGh0dEBxX9S0lVlLV6ZmIbmP0QGobgojinmsDaKhDgFAGSQxkQYRoGmoYgFAMdcGBhS9UDFUNw9Q+FERYnEfACnizFooLBuVAAAAAElFTkSuQmCC',
			'8F25' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbklEQVR4nGNYhQEaGAYTpIn7WANEQx1CGUMDkMREpog0MDo6OiCrC2gVaWBtCEQRA6ljaAh0dUBy39KoqWGrVmZGRSG5D6yuFUijmccwBYtYAKODCJodjA4MAcjuYw0AuiU0YKrDIAg/KkIs7gMAyNHLKHnlltQAAAAASUVORK5CYII=',
			'E5AF' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7QkNEQxmmMIaGIIkFNIg0MIQyOjCgiTE6OqKLhbA2BMLEwE4KjZq6dOmqyNAsJPcFNDA0uiLUIcRC0cVEsKhjbWVFEwsNYQxBFxuo8KMixOI+AHL5y70bzi89AAAAAElFTkSuQmCC',
			'D992' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7QgMYQxhCGaY6IIkFTGFtZXR0CAhAFmsVaXRtCHQQwRALaBBBcl/U0qVLMzOjVkUhuS+glTHQISSgEcWOVgYgH0iiiLE0OgJtZ8DiFkw3M4aGDILwoyLE4j4A7/LOTr7PRtsAAAAASUVORK5CYII=',
			'F52A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbElEQVR4nGNYhQEaGAYTpIn7QkNFQxlCGVqRxQIaRBoYHR2mOqCJsTYEBASgioUwNAQ6iCC5LzRq6tJVKzOzpiG5D6in0aGVEaYOITaFMTQE1bxGhwB0daxAnehijCGsoYEoYgMVflSEWNwHAKlQzGe/ViXWAAAAAElFTkSuQmCC',
			'0EE9' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXklEQVR4nGNYhQEaGAYTpIn7GB1EQ1lDHaY6IImxBog0sDYwBAQgiYlMAYkxOoggiQW0ooiBnRS1dGrY0tBVUWFI7oOoY5iKqRdoLoYdDCh2YHMLNjcPVPhREWJxHwDYhMpgHKyOOgAAAABJRU5ErkJggg==',
			'159A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAc0lEQVR4nGNYhQEaGAYTpIn7GB1EQxlCGVqRxVgdRBoYHR2mOiCJiQLFWBsCAgJQ9IqEsDYEAmUQ7luZNXXpyszIrGlI7mN0YGh0CIGrQ4g1BIaGoJrX6NiAro61ldHREUVMNIQxhCGUEUVsoMKPihCL+wDdWMim0roitAAAAABJRU5ErkJggg==',
			'13A3' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbklEQVR4nGNYhQEaGAYTpIn7GB1YQximMIQ6IImxOoi0MoQyOgQgiYk6MDQ6Ojo0iKDoZWhlbQhoCEBy38qsVWFLV0UtzUJyH5o6mFija2gAunmNrg3oYiJAvYGobglhDQGah+LmgQo/KkIs7gMA9dnKttYKXFsAAAAASUVORK5CYII=',
			'42E3' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpI37pjCGsIY6hDogi4WwtrI2MDoEIIkxhog0ugJpESQx1ikMYLEAJPdNm7Zq6dLQVUuzkNwXMIVhCitCHRiGhjIEsKKZB3SLA6YYawO6WximiIa6ort5oMKPehCL+wC53MvhQ7J9NwAAAABJRU5ErkJggg==',
			'5690' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7QkMYQxhCGVqRxQIaWFsZHR2mOqCIiTSyNgQEBCCJBQaINLA2BDqIILkvbNq0sJWZkVnTkN3XKtrKEAJXBxUTaXRoQBULAIo5otkhMgXTLawBmG4eqPCjIsTiPgAXrcwPnwQt/QAAAABJRU5ErkJggg==',
			'8728' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdklEQVR4nGNYhQEaGAYTpIn7WANEQx1CGaY6IImJTGFodHR0CAhAEgtoZWh0bQh0EEFV1wqUgakDO2lp1Kppq1ZmTc1Cch9QXQBQJZp5jA4MUxhRzAtoZW1gCGBEs0OkAagSRS9rgEgDa2gAipsHKvyoCLG4DwAo6sv3CtSn7gAAAABJRU5ErkJggg==',
			'66D5' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7WAMYQ1hDGUMDkMREprC2sjY6OiCrC2gRaWRtCEQVaxBpAIq5OiC5LzJqWthSIBmF5L6QKaKtrGDVSHpbRRpdsYoFOohguMUhANl9EDczTHUYBOFHRYjFfQBzQsyqunhKmwAAAABJRU5ErkJggg==',
			'6FB3' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7WANEQ11DGUIdkMREpog0sDY6OgQgiQW0AMUaAhpEkMUaQOocGgKQ3BcZNTVsaeiqpVlI7guZgqIOorcVi3lYxLC5hTUAKIbm5oEKPypCLO4DAHjYzgnfCkmvAAAAAElFTkSuQmCC',
			'44DA' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpI37pjC0soYytKKIhTBMZW10mOqAJMYYwhDK2hAQEIAkxjqF0ZW1IdBBBMl906YtXbp0VWTWNCT3BUwRaUVSB4ahoaKhrg2BoSHobkFTBxZrdMQUC2VEFRuo8KMexOI+AK5Ey8ZGnuwGAAAAAElFTkSuQmCC',
			'A957' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdElEQVR4nGNYhQEaGAYTpIn7GB0YQ1hDHUNDkMRYA1hbWYG0CJKYyBSRRlc0sYBWoNhUII3kvqilS5emZmatzEJyX0ArY6ADkES2NzSUoREoNoUBxTwWoB0BAahirK2Mjo4OqGKMIQyhjChiAxV+VIRY3AcAk7DMh+4arUUAAAAASUVORK5CYII=',
			'8ECC' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWUlEQVR4nGNYhQEaGAYTpIn7WANEQxlCHaYGIImJTBFpYHQICBBBEgtoFWlgbRB0YEFTxwpUiey+pVFTw5auWpmF7D40dUjmYRPDtAPdLdjcPFDhR0WIxX0AdZDKzpMVQLcAAAAASUVORK5CYII=',
			'27FE' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7WANEQ11DA0MDkMREpjA0ujYwOiCrC2jFFGNoZWhlRYhB3DRt1bSloStDs5DdF8AQwIqml9GB0QFdjBUMUcVEgBBdLDQULIbi5oEKPypCLO4DAAsVyKzeN4XCAAAAAElFTkSuQmCC',
			'E21D' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7QkMYQximMIY6IIkFNLC2MoQwOgSgiIk0OgLFRFDEGBodpsDFwE4KjVq1dNW0lVnTkNwHVDeFYQqG3gBMMUYHTDHWBpAYsltCQ0RDHYEQ2c0DFX5UhFjcBwB+fsurb5zHzAAAAABJRU5ErkJggg==',
			'672D' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAd0lEQVR4nGNYhQEaGAYTpIn7WANEQx1CGUMdkMREpjA0Ojo6OgQgiQW0MDS6NgQ6iCCLNTC0MiDEwE6KjFo1bdXKzKxpSO4LmcIQwNDKiKoXyGeYgi7G2sAQgComMkWkgdGBEcUtrAEiDayhgShuHqjwoyLE4j4AyZ7K4EbdlLUAAAAASUVORK5CYII=',
			'373B' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7RANEQx1DGUMdkMQCpjA0ujY6OgQgq2xlaHRoCHQQQRabAhKFqwM7aWXUqmmrpq4MzUJ23xSGAAYM8xgdGNDNa2VtQBcLmCLSwIqmVzRApIERzc0DFX5UhFjcBwAnJMwGHCtw/gAAAABJRU5ErkJggg==',
			'73D5' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7QkNZQ1hDGUMDkEVbRVpZGx0dUFS2MjS6NgSiik1haGVtCHR1QHZf1Kqwpasio6KQ3MfoAFIX0CCCpJe1AWQeqphIA8QOZDGgCqBbHAICUMRAbmaY6jAIwo+KEIv7AMMDzCcoQnQtAAAAAElFTkSuQmCC',
			'CDDD' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWElEQVR4nGNYhQEaGAYTpIn7WENEQ1hDGUMdkMREWkVaWRsdHQKQxAIaRRpdGwIdRJDFGlDEwE6KWjVtZeqqyKxpSO5DU4dbDIsd2NyCzc0DFX5UhFjcBwDEzs15VQfh8QAAAABJRU5ErkJggg==',
			'4543' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAd0lEQVR4nGNYhQEaGAYTpI37poiGMjQ6hDogi4WINDC0OjoEIIkxgsSmOjSIIImxThEJYQh0aAhAct+0aVOXrszMWpqF5L6AKQyNro1wdWAYCrTVNTQAxTyGKSKNDo0OaGKsrQyNqG5hmMIYguHmgQo/6kEs7gMABm3N0+ChKUAAAAAASUVORK5CYII=',
			'BC4D' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpIn7QgMYQxkaHUMdkMQCprA2OrQ6OgQgi7WKNDhMdXQQQVEH5AXCxcBOCo2atmplZmbWNCT3gdSxNqLpBZrHGhqIIeaArg7klkZUt2Bz80CFHxUhFvcBAMRuzkBrG0OJAAAAAElFTkSuQmCC',
			'E75E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7QkNEQ11DHUMDkMSA7EbXBkYHBsJiraxT4WJgJ4VGrZq2NDMzNAvJfUB1AQwNgWh6QfrQxViBEF1MpIHR0RFFLDREpIEhlBHFzQMVflSEWNwHAN7Tyv6KyK4LAAAAAElFTkSuQmCC',
			'C8ED' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWklEQVR4nGNYhQEaGAYTpIn7WEMYQ1hDHUMdkMREWllbWRsYHQKQxAIaRRpdgWIiyGINEHUiSO6LWrUybGnoyqxpSO5DUwcVw2IeFjuwuQWbmwcq/KgIsbgPALPdywaWtL2DAAAAAElFTkSuQmCC',
			'3F3B' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXUlEQVR4nGNYhQEaGAYTpIn7RANEQx1DGUMdkMQCpog0sDY6OgQgq2wVAZKBDiLIYkB1DAh1YCetjJoatmrqytAsZPehqsNtHhYxbG4RDRBpYERz80CFHxUhFvcBAAmPzAxQ6CHyAAAAAElFTkSuQmCC',
			'23E7' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7WANYQ1hDHUNDkMREpoi0soJoJLGAVoZGVzQxhlYGsLoAZPdNWxW2NHTVyixk9wWA1bUi28voADZvCopbGsBiAchiIg0gtwBVI4mFhoLdjCI2UOFHRYjFfQBhEcqC0TISxwAAAABJRU5ErkJggg==',
			'1E65' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZ0lEQVR4nGNYhQEaGAYTpIn7GB1EQxlCGUMDkMRYHUQaGB0dHZDViQLFWBtQxRjBYoyuDkjuW5k1NWzp1JVRUUjuA6tzdGgQwdAbgEUs0AFdjNHRIQDZfaIhIDczTHUYBOFHRYjFfQC5UMgRjDec9AAAAABJRU5ErkJggg==',
			'E4F5' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZUlEQVR4nGNYhQEaGAYTpIn7QkMYWllDA0MDkMSA7KmsDYwODKhioZhijK5AMVcHJPeFRi1dujR0ZVQUkvsCGkRaWYG0CIpe0VBXDDGgW4B2YIoxBCC7D+xmoBsdBkH4URFicR8AORfLliUhkWMAAAAASUVORK5CYII=',
			'0D75' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7GB1EQ1hDA0MDkMRYA0RaGRoCHZDViUwRaXRAEwtoBYo1Oro6ILkvaum0lVlLV0ZFIbkPrG4K0Ax0vQGoYiA7HB0YHUTQ3MLawBCA7D6wmxsYpjoMgvCjIsTiPgD5rsv3ghmA7AAAAABJRU5ErkJggg==',
			'EB68' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWklEQVR4nGNYhQEaGAYTpIn7QkNEQxhCGaY6IIkFNIi0Mjo6BASgijW6Njg6iKCpY21ggKkDOyk0amrY0qmrpmYhuQ+sDqt5gejmYRPDcAs2Nw9U+FERYnEfACerzdD0SW36AAAAAElFTkSuQmCC',
			'4CD1' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZElEQVR4nGNYhQEaGAYTpI37pjCGsoYytKKIhbA2ujY6TEUWYwwRaXBtCAhFFmOdItLA2hAA0wt20rRp01YtXRW1FNl9AajqwDA0FFOMYQrYDjQxsFvQxMBuDg0YDOFHPYjFfQCgac2BPxEJZAAAAABJRU5ErkJggg==',
			'96E2' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7WAMYQ1hDHaY6IImJTGFtZW1gCAhAEgtoFWlkbWB0EEEVa2AFqUdy37Sp08KWhq5aFYXkPlZXUZB5jch2MADNcwWSyG4RgIhNYcDiFkw3O4aGDILwoyLE4j4AJBXLRvNXPpsAAAAASUVORK5CYII=',
			'E37E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7QkNYQ1hDA0MDkMQCGkRaGRoCHRhQxBgaHTDFWhkaHWFiYCeFRq0KW7V0ZWgWkvvA6qYwYpoXgCnm6IAuJtLK2oAqBnZzAyOKmwcq/KgIsbgPADn7yzF33lJCAAAAAElFTkSuQmCC',
			'970F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbklEQVR4nGNYhQEaGAYTpIn7WANEQx2mMIaGIImJTGFodAhldEBWF9DK0Ojo6Igu1sraEAgTAztp2tRV05auigzNQnIfqytDAJI6CGxldEAXEwCaxohmh8gUkQYGNLewBgDFpqCKDVT4URFicR8AwbnJG5dKZpMAAAAASUVORK5CYII=',
			'3131' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZElEQVR4nGNYhQEaGAYTpIn7RAMYAhhDGVqRxQKmMAawNjpMRVHZyhoAlAlFEZvCEMDQ6ADTC3bSyqhVUaumrlqK4j5UdVDzGEDmERQLAOplRdMrGsAaCnRzaMAgCD8qQizuAwALvsqKU+kKfAAAAABJRU5ErkJggg==',
			'7B54' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdUlEQVR4nGNYhQEaGAYTpIn7QkNFQ1hDHRoCkEVbRVpZGxga0cQaXYEkitgUoLqpDFMCkN0XNTVsaWZWVBSS+xgdRFoZGgIdkPWyNog0OjQEhoYgiYk0gOwIQHFLQINIK6OjA5qYaAhDKAOqmwco/KgIsbgPACs9zey7Mgy2AAAAAElFTkSuQmCC',
			'86FB' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAX0lEQVR4nGNYhQEaGAYTpIn7WAMYQ1hDA0MdkMREprC2sjYwOgQgiQW0ijSCxERQ1Ik0IKkDO2lp1LSwpaErQ7OQ3CcyRRSrea5o5mETw+YWsJsbGFHcPFDhR0WIxX0Aab/Kzf1XODoAAAAASUVORK5CYII=',
			'388E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAUUlEQVR4nGNYhQEaGAYTpIn7RAMYQxhCGUMDkMQCprC2Mjo6OqCobBVpdG0IRBVDVQd20sqolWGrQleGZiG7j1jzsIhhcws2Nw9U+FERYnEfANuLyZJixZtlAAAAAElFTkSuQmCC',
			'8FA1' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAW0lEQVR4nGNYhQEaGAYTpIn7WANEQx2mMLQii4lMEWlgCGWYiiwW0CrSwOjoEIqujhUog+y+pVFTw5auilqK7D40dXDzWEOxiKGpw6aXNQAsFhowCMKPihCL+wAR9c0rj7yv5QAAAABJRU5ErkJggg==',
			'4903' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpI37pjCGMExhCHVAFgthbWUIZXQIQBJjDBFpdHR0aBBBEmOdItLo2hDQEIDkvmnTli5NXRW1NAvJfQFTGAOR1IFhaCgDWK8IiltYMOxgmILpFqxuHqjwox7E4j4A3WfM1m0A+pcAAAAASUVORK5CYII=',
			'32C2' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdUlEQVR4nM2QMQqAMAxFf4fuCvU+cXDP0C49TTp4g3gEBz2ldkvRUaH5kMAjhEdwPkrQU37xm9hFJNrIMFa/OmJmu7mGsshIwTLFzSDB+B353Pd7ZuunUC8o1NwD+9ob5sjLoGhdpLq0zlOiNKfYwf8+zIvfBfd0y+Ow61ctAAAAAElFTkSuQmCC',
			'B253' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nGNYhQEaGAYTpIn7QgMYQ1hDHUIdkMQCprC2sjYwOgQgi7WKNLoCaREUdQyNrlOBNJL7QqNWLV2ambU0C8l9QHVTQKpQzWMIAImhmNfK6MCKLjYF6BJHRxS3hAaIAl3MgOLmgQo/KkIs7gMArsfOJD2/I9AAAAAASUVORK5CYII=',
			'AB5F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7GB1EQ1hDHUNDkMRYA0RaWYEyyOpEpog0uqKJBbQC1U2Fi4GdFLV0atjSzMzQLCT3gdQxNASi6A0NFWl0QBMDqgPagSHWyujoiCYmGsIQiuqWgQo/KkIs7gMAwSvKbV3w400AAAAASUVORK5CYII=',
			'2CB7' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nGNYhQEaGAYTpIn7WAMYQ1lDGUNDkMREprA2ujY6NIggiQW0ijS4NgSgiDEAxViB6gKQ3Tdt2qqloatWZiG7LwCsrhXZXkYHoFhDwBQUtzSA7QhAFgPpdG10dEAWCw0FuxlFbKDCj4oQi/sAClXMoSxC02AAAAAASUVORK5CYII=',
			'FD5A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpIn7QkNFQ1hDHVqRxQIaRFpZGximOqCKNbo2MAQEoItNZXQQQXJfaNS0lamZmVnTkNwHUufQEAhThywWGoJhB4a6VkZHRzQx0RCGUEYUsYEKPypCLO4DACDWzZ7hBKMmAAAAAElFTkSuQmCC',
			'2B6A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdElEQVR4nGNYhQEaGAYTpIn7WANEQxhCGVqRxUSmiLQyOjpMdUASC2gVaXRtcAgIQNbdKtLK2sDoIILsvmlTw5ZOXZk1Ddl9AUB1jo4wdWAI1AU0LzA0BNktDWAxFHUiDSC3oOoNDQW5mRFFbKDCj4oQi/sAFanLLlKFP/UAAAAASUVORK5CYII=',
			'BF81' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWElEQVR4nGNYhQEaGAYTpIn7QgNEQx1CGVqRxQKmiDQwOjpMRRFrFWlgbQgIxaIOphfspNCoqWGrQlctRXYfmjpk8wiLYdEbGiDSwBDKEBowCMKPihCL+wCXtc1e99oudAAAAABJRU5ErkJggg==',
			'C758' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdElEQVR4nGNYhQEaGAYTpIn7WENEQ11DHaY6IImJtDI0ujYwBAQgiQU0gsQYHUSQxRoYWlmnwtWBnRS1atW0pZlZU7OQ3AeUDwCSqOYBzWJoCEQ1r5G1gRVNTKRVpIHR0QFFL2sIUEUoA4qbByr8qAixuA8A5kPMnvMx4XkAAAAASUVORK5CYII=',
			'E610' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZ0lEQVR4nGNYhQEaGAYTpIn7QkMYQximMLQiiwU0sLYyhDBMdUARE2kEqgwIQBVrYJjC6CCC5L7QqGlhq6atzJqG5L6ABtFWJHVw8xywiqHbAXTLFFS3gNzMGOqA4uaBCj8qQizuAwCQCMymvh3SOwAAAABJRU5ErkJggg==',
			'2E45' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAc0lEQVR4nGNYhQEaGAYTpIn7WANEQxkaHUMDkMREpog0MLQ6OiCrC2gFik1FFWMAiQU6ujogu2/a1LCVmZlRUcjuCxBpYG10aBBB0svoABQD2oosxgriNTo6IIuJgMUcApDdFxoKcrPDVIdBEH5UhFjcBwAGjMtvlSqn6wAAAABJRU5ErkJggg==',
			'3C37' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYUlEQVR4nGNYhQEaGAYTpIn7RAMYQ0EwBEksYApro2ujQ4MIsspWkQaHhgBUsSlAXiNIFOG+lVHTVq2aumplFrL7IOpaGdDMA9mELgY0LYABwy2ODljcjCI2UOFHRYjFfQCx180mT146rQAAAABJRU5ErkJggg==',
			'B766' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcElEQVR4nGNYhQEaGAYTpIn7QgNEQx1CGaY6IIkFTGFodHR0CAhAFmtlaHRtcHQQQFXXytrA6IDsvtCoVdOWTl2ZmoXkPqC6AFZHRzTzGB1YGwIdRFDEWBswxKaINDCiuSU0AKgCzc0DFX5UhFjcBwB5qs0jP6rYfQAAAABJRU5ErkJggg==',
			'C12D' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7WEMYAhhCGUMdkMREWhkDGB0dHQKQxAIaWQNYGwIdRJDFGoB6EWJgJ0WB0MrMrGlI7gOra2XE1DsFTawRKBaAKibSChJhRHELawhrKGtoIIqbByr8qAixuA8A33zIrCWYid8AAAAASUVORK5CYII=',
			'69EE' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAW0lEQVR4nGNYhQEaGAYTpIn7WAMYQ1hDHUMDkMREprC2sjYwOiCrC2gRaXRFF2tAEQM7KTJq6dLU0JWhWUjuC5nCGIiht5UB07xWFgwxbG7B5uaBCj8qQizuAwB9JMoE/z/EfgAAAABJRU5ErkJggg==',
			'A978' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAd0lEQVR4nGNYhQEaGAYTpIn7GB0YQ1hDA6Y6IImxBrC2MjQEBAQgiYlMEWl0aAh0EEESC2gFijU6wNSBnRS1dOnSrKWrpmYhuS+glTHQYQoDinmhoQxAnYxo5rE0Ojqgi7G2sjag6gWaFwIUQ3HzQIUfFSEW9wEAffvNQKOO0zAAAAAASUVORK5CYII=',
			'4832' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpI37pjCGMIYyTHVAFgthbWVtdAgIQBJjDBFpdGgIdBBBEmOdwtrKABQVQXLftGkrw1ZNXbUqCsl9ARB1jch2hIaCzAtoRXULWGwKqhjELZhuZgwNGQzhRz2IxX0AVS/NMJN1I7QAAAAASUVORK5CYII=',
			'BDF0' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXklEQVR4nGNYhQEaGAYTpIn7QgNEQ1hDA1qRxQKmiLSyNjBMdUAWaxVpdG1gCAhAVQcUY3QQQXJfaNS0lamhK7OmIbkPTR2SedjEMOzAcAvYzQ0MKG4eqPCjIsTiPgBgbM3nj91kvQAAAABJRU5ErkJggg==',
			'5365' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdElEQVR4nGNYhQEaGAYTpIn7QkNYQxhCGUMDkMQCGkRaGR0dHRhQxBgaXRtQxQIDGFpZGxhdHZDcFzZtVdjSqSujopDd1wpU5+jQIIJscyvIvAAUsQCwWKADspjIFJBbHAKQ3ccaAHIzw1SHQRB+VIRY3AcASEPLjREjttYAAAAASUVORK5CYII=',
			'D453' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbklEQVR4nGNYhQEaGAYTpIn7QgMYWllDHUIdkMQCpjBMZW1gdAhAFmtlCGUF0iIoYoyurFOBNJL7opYCQWbW0iwk9wW0irSCVKGaJwq0MwDNPKBb0MWmMLQyOjqiuAXkZoZQBhQ3D1T4URFicR8AeIHODzdL/EQAAAAASUVORK5CYII=',
			'4463' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbElEQVR4nGNYhQEaGAYTpI37pjC0MoQyhDogi4UwTGV0dHQIQBJjDGEIZW1waBBBEmOdwujKCqQDkNw3bdrSpUunrlqaheS+gCkirayODg3I5oWGioa6AkVE0NzCikUM3S1Y3TxQ4Uc9iMV9AOv6zCvaFX43AAAAAElFTkSuQmCC',
			'9436' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nGNYhQEaGAYTpIn7WAMYWhlDGaY6IImJTGGYytroEBCAJBbQyhDK0BDoIIAixujK0OjogOy+aVOXLl01dWVqFpL7WF1FWoHqUMxjaBUNdQCaJ4IkJtDK0MqAJgZ0Syu6W7C5eaDCj4oQi/sA5rLL954wVI8AAAAASUVORK5CYII=',
			'F71A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpIn7QkNFQx2mMLQiiwU0MDQ6hDBMdUATcwxhCAhAFWtlmMLoIILkvtCoVdNWTVuZNQ3JfUB1AUjqoGKMDkCx0BAUMdYGTHUiWMUYQx1RxAYq/KgIsbgPAH/6zEBhEqYeAAAAAElFTkSuQmCC',
			'121B' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbklEQVR4nGNYhQEaGAYTpIn7GB0YQximMIY6IImxOrC2MoQwOgQgiYk6iDQ6AsVEUPQyNDpMgasDO2ll1qqlq6atDM1Cch9Q3RSGKajmAcUCQGKo5oFUoouxNqDrFQ0RDXUEQmQ3D1T4URFicR8Am8bHzWBjnuUAAAAASUVORK5CYII=',
			'76B8' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7QkMZQ1hDGaY6IIu2srayNjoEBKCIiTSyNgQ6iCCLTRFpQFIHcVPUtLCloaumZiG5j9FBFMM81gaRRlc080SwiAU0YLoloAGLmwco/KgIsbgPAKluzL+P6yveAAAAAElFTkSuQmCC',
			'F55E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYUlEQVR4nGNYhQEaGAYTpIn7QkNFQ1lDHUMDkMQCGkQaWBsYHRgIi4WwToWLgZ0UGjV16dLMzNAsJPcBzW50aAhE04tNTKTRFUOMtZXR0RFNjDGEIZQRxc0DFX5UhFjcBwAUpcthU4iLuQAAAABJRU5ErkJggg==',
			'F960' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZUlEQVR4nGNYhQEaGAYTpIn7QkMZQxhCGVqRxQIaWFsZHR2mOqCIiTS6NjgEBGCIMTqIILkvNGrp0tSpK7OmIbkvoIEx0NXREaYOKsYA1BuIJsYCFAtAswObWzDdPFDhR0WIxX0A9iXNrC3BqsoAAAAASUVORK5CYII=',
			'95D9' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nGNYhQEaGAYTpIn7WANEQ1lDGaY6IImJTBFpYG10CAhAEgtoBYo1BDqIoIqFIImBnTRt6tSlS1dFRYUhuY/VlaHRtSFgKrJehlawWAOymECrCEgMxQ6RKayt6G5hDWAMQXfzQIUfFSEW9wEA70LMz+2TUUAAAAAASUVORK5CYII=',
			'E8FB' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAUklEQVR4nGNYhQEaGAYTpIn7QkMYQ1hDA0MdkMQCGlhbWRsYHQJQxEQaXYFiIrjVgZ0UGrUybGnoytAsJPcRbx5BOxBubmBEcfNAhR8VIRb3AQDlfsvvYo+ONAAAAABJRU5ErkJggg==',
			'8E44' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYUlEQVR4nGNYhQEaGAYTpIn7WANEQxkaHRoCkMREpog0MLQ6NCKLBbQCxaY6tGKoC3SYEoDkvqVRU8NWZmZFRSG5D6SOtdHRAd081tDA0BB0O7C5BU0Mm5sHKvyoCLG4DwBCss6yHtSKBQAAAABJRU5ErkJggg==',
			'3275' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcElEQVR4nGNYhQEaGAYTpIn7RAMYQ1hDA0MDkMQCprC2MjQEOqCobBVpdEAXm8LQ6NDo6OqA5L6VUauWrlq6MioK2X1TwLBBBMU8hgAgRBNjdABBEVS3NLA2MAQgu080QDTUtYFhqsMgCD8qQizuAwAemMs10PbGQQAAAABJRU5ErkJggg==',
			'6D10' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZ0lEQVR4nGNYhQEaGAYTpIn7WANEQximMLQii4lMEWllCGGY6oAkFtAi0ugYwhAQgCzWINLoMIXRQQTJfZFR01ZmgRCS+0KmoKiD6G3FJYZqB9gtU1DdAnIzY6gDipsHKvyoCLG4DwD3Jszt0BpzvQAAAABJRU5ErkJggg==',
			'B4A0' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7QgMYWhmmADGSWMAUhqkMoQxTHZDFWhlCGR0dAgJQ1DG6sjYEOogguS80aunSpasis6YhuS9gikgrkjqoeaKhrqHoYgxAdQFodoDFUNwCcjMrSPUgCD8qQizuAwAXbc39tSll1gAAAABJRU5ErkJggg==',
			'4272' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nM2QMQ6AMAgA6cAP6n9Y3DEpi6+hQ39Q+wOXvlLcqDpqIrddSLgA/TYKf+KbvhoSCm/kXcICyszOhRQz6ULROayQyWx0fa313eir6+MKJ9nfEAE2yqWFAtnm4FBRbXNwk8waJP3hf+/x0HcAYGzMGDX4fLUAAAAASUVORK5CYII=',
			'27C8' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nGNYhQEaGAYTpIn7WANEQx1CHaY6IImJTGFodHQICAhAEgtoZWh0bRB0EEHW3crQytrAAFMHcdO0VdOWrlo1NQvZfQEMAUjqwJDRgdGBFUgim8cKhqh2iAAhI5pbQkOBKtDcPFDhR0WIxX0AlgDLi4CFNI8AAAAASUVORK5CYII=',
			'AC0E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYklEQVR4nGNYhQEaGAYTpIn7GB0YQxmmMIYGIImxBrA2OoQyOiCrE5ki0uDo6IgiFtAq0sDaEAgTAzspaum0VUtXRYZmIbkPTR0YhoZiioHUYdqB6ZaAVkw3D1T4URFicR8AYwfLBlMuLckAAAAASUVORK5CYII=',
			'8E08' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAX0lEQVR4nGNYhQEaGAYTpIn7WANEQxmmMEx1QBITmSLSwBDKEBCAJBbQKtLA6OjoIIKmjrUhAKYO7KSlUVPDlq6KmpqF5D40dXDzWBsCUczDZQe6W7C5eaDCj4oQi/sA8rLMBL+Us1kAAAAASUVORK5CYII=',
			'6510' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdElEQVR4nGNYhQEaGAYTpIn7WANEQxmmMLQii4lMEWlgCGGY6oAkFtAi0sAYwhAQgCzWIBLCMIXRQQTJfZFRU5eumrYyaxqS+0KmMDQ6INRB9LZiExMBiqHaITKFtRXoPhS3sAYwhjCGOqC4eaDCj4oQi/sA+d3MK0qd5VwAAAAASUVORK5CYII=',
			'9561' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nGNYhQEaGAYTpIn7WANEQxlCGVqRxUSmiDQwOjpMRRYLaBVpYG1wCEUTC2FtgOsFO2na1KlLl05dtRTZfayuDI2ujg4odgB1NboCTUAWE2gVwRATmcLayoimlzWAMQTo5tCAQRB+VIRY3AcA0WLL8AKueFoAAAAASUVORK5CYII=',
			'1A24' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcklEQVR4nGNYhQEaGAYTpIn7GB0YAhhCGRoCkMRYHRhDGB0dGpHFRB1YW1kbAloDUPSKNDo0BEwJQHLfyqxpK7NWZkVFIbkPrK6V0QFVr2iowxTG0BB08wJQ3QISc3RAFRMNEWl0DQ1AERuo8KMixOI+AJEPyy5L62JzAAAAAElFTkSuQmCC',
			'006F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXklEQVR4nGNYhQEaGAYTpIn7GB0YAhhCGUNDkMRYAxhDGB0dHZDViUxhbWVtQBULaBVpdAWZgOS+qKXTVqZOXRmaheQ+sDpHbHoDsdiBKobNLVA3o4gNVPhREWJxHwDPQsidV4kXWgAAAABJRU5ErkJggg==',
			'F782' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nM2QMQ6AMAhF6dAb1PvQwR0TWXoaOvQG6iE4pYylOmpS/vbyCS+APkZgpvzix7wwMpzYMRKoOSPRwFbZMHnWQkZJnR8XvZRVS+dnPbJe9TcCRqEGjkULHZ4lsV0aGXDgfYL/fZgXvxvYNs1jd2PgAgAAAABJRU5ErkJggg==',
			'3D5C' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7RANEQ1hDHaYGIIkFTBFpZW1gCBBBVtkq0ujawOjAgiw2BSg2ldEB2X0ro6atTM3MzEJxH1CdQ0OgAwOaedjEXIFiyHaA3MLo6IDiFpCbGUIZUNw8UOFHRYjFfQCYusu3OjRDVgAAAABJRU5ErkJggg==',
			'9600' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZ0lEQVR4nGNYhQEaGAYTpIn7WAMYQximMLQii4lMYW1lCGWY6oAkFtAq0sjo6BAQgCrWwNoQ6CCC5L5pU6eFLV0VmTUNyX2srqKtSOogEGieK5qYAFDMEc0ObG7B5uaBCj8qQizuAwBYvMuFGmWDYgAAAABJRU5ErkJggg==',
			'A7ED' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZUlEQVR4nGNYhQEaGAYTpIn7GB1EQ11DHUMdkMRYAxgaXYEyAUhiIlMgYiJIYgGtDK2sCDGwk6KWrpq2NHRl1jQk9wHVBbCi6Q0NZXRAFwsAmoYpJgIWC0AXQ3PzQIUfFSEW9wEAgJPK+zPnzrwAAAAASUVORK5CYII=',
			'2150' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcklEQVR4nGNYhQEaGAYTpIn7WAMYAlhDHVqRxUSmMAawNjBMdUASC2hlBYkFBCDrbgXqncroIILsvmmropZmZmZNQ3Yf0A6GhkCYOjBkdMAUA5nP2hCAYgdQPoDR0QHFLaGhrKEMoQwobh6o8KMixOI+AEHmyQ6oZFH2AAAAAElFTkSuQmCC'        
        );
        $this->text = array_rand( $images );
        return $images[ $this->text ] ;    
    }
    
    function out_processing_gif(){
        $image = dirname(__FILE__) . '/processing.gif';
        $base64_image = "R0lGODlhFAAUALMIAPh2AP+TMsZiALlcAKNOAOp4ANVqAP+PFv///wAAAAAAAAAAAAAAAAAAAAAAAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFCgAIACwAAAAAFAAUAAAEUxDJSau9iBDMtebTMEjehgTBJYqkiaLWOlZvGs8WDO6UIPCHw8TnAwWDEuKPcxQml0Ynj2cwYACAS7VqwWItWyuiUJB4s2AxmWxGg9bl6YQtl0cAACH5BAUKAAgALAEAAQASABIAAAROEMkpx6A4W5upENUmEQT2feFIltMJYivbvhnZ3Z1h4FMQIDodz+cL7nDEn5CH8DGZhcLtcMBEoxkqlXKVIgAAibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkphaA4W5upMdUmDQP2feFIltMJYivbvhnZ3V1R4BNBIDodz+cL7nDEn5CH8DGZAMAtEMBEoxkqlXKVIg4HibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkpjaE4W5tpKdUmCQL2feFIltMJYivbvhnZ3R0A4NMwIDodz+cL7nDEn5CH8DGZh8ONQMBEoxkqlXKVIgIBibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkpS6E4W5spANUmGQb2feFIltMJYivbvhnZ3d1x4JMgIDodz+cL7nDEn5CH8DGZgcBtMMBEoxkqlXKVIggEibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkpAaA4W5vpOdUmFQX2feFIltMJYivbvhnZ3V0Q4JNhIDodz+cL7nDEn5CH8DGZBMJNIMBEoxkqlXKVIgYDibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkpz6E4W5tpCNUmAQD2feFIltMJYivbvhnZ3R1B4FNRIDodz+cL7nDEn5CH8DGZg8HNYMBEoxkqlXKVIgQCibbK9YLBYvLtHH5K0J0IACH5BAkKAAgALAEAAQASABIAAAROEMkpQ6A4W5spIdUmHQf2feFIltMJYivbvhnZ3d0w4BMAIDodz+cL7nDEn5CH8DGZAsGtUMBEoxkqlXKVIgwGibbK9YLBYvLtHH5K0J0IADs=";
        $binary = is_file($image) ? join("",file($image)) : base64_decode($base64_image); 
        header("Cache-Control: post-check=0, pre-check=0, max-age=0, no-store, no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: image/gif");
        echo $binary;
    }

}
# end of class phpfmgImage
# ------------------------------------------------------
# end of module : captcha


# module user
# ------------------------------------------------------
function phpfmg_user_isLogin(){
    return ( isset($_SESSION['authenticated']) && true === $_SESSION['authenticated'] );
}


function phpfmg_user_logout(){
    session_destroy();
    header("Location: admin.php");
}

function phpfmg_user_login()
{
    if( phpfmg_user_isLogin() ){
        return true ;
    };
    
    $sErr = "" ;
    if( 'Y' == $_POST['formmail_submit'] ){
        if(
            defined( 'PHPFMG_USER' ) && strtolower(PHPFMG_USER) == strtolower($_POST['Username']) &&
            defined( 'PHPFMG_PW' )   && strtolower(PHPFMG_PW) == strtolower($_POST['Password']) 
        ){
             $_SESSION['authenticated'] = true ;
             return true ;
             
        }else{
            $sErr = 'Login failed. Please try again.';
        }
    };
    
    // show login form 
    phpfmg_admin_header();
?>
<form name="frmFormMail" action="" method='post' enctype='multipart/form-data'>
<input type='hidden' name='formmail_submit' value='Y'>
<br><br><br>

<center>
<div style="width:380px;height:260px;">
<fieldset style="padding:18px;" >
<table cellspacing='3' cellpadding='3' border='0' >
	<tr>
		<td class="form_field" valign='top' align='right'>Email :</td>
		<td class="form_text">
            <input type="text" name="Username"  value="<?php echo $_POST['Username']; ?>" class='text_box' >
		</td>
	</tr>

	<tr>
		<td class="form_field" valign='top' align='right'>Password :</td>
		<td class="form_text">
            <input type="password" name="Password"  value="" class='text_box'>
		</td>
	</tr>

	<tr><td colspan=3 align='center'>
        <input type='submit' value='Login'><br><br>
        <?php if( $sErr ) echo "<span style='color:red;font-weight:bold;'>{$sErr}</span><br><br>\n"; ?>
        <a href="admin.php?mod=mail&func=request_password">I forgot my password</a>   
    </td></tr>
</table>
</fieldset>
</div>
<script type="text/javascript">
    document.frmFormMail.Username.focus();
</script>
</form>
<?php
    phpfmg_admin_footer();
}


function phpfmg_mail_request_password(){
    $sErr = '';
    if( $_POST['formmail_submit'] == 'Y' ){
        if( strtoupper(trim($_POST['Username'])) == strtoupper(trim(PHPFMG_USER)) ){
            phpfmg_mail_password();
            exit;
        }else{
            $sErr = "Failed to verify your email.";
        };
    };
    
    $n1 = strpos(PHPFMG_USER,'@');
    $n2 = strrpos(PHPFMG_USER,'.');
    $email = substr(PHPFMG_USER,0,1) . str_repeat('*',$n1-1) . 
            '@' . substr(PHPFMG_USER,$n1+1,1) . str_repeat('*',$n2-$n1-2) . 
            '.' . substr(PHPFMG_USER,$n2+1,1) . str_repeat('*',strlen(PHPFMG_USER)-$n2-2) ;


    phpfmg_admin_header("Request Password of Email Form Admin Panel");
?>
<form name="frmRequestPassword" action="admin.php?mod=mail&func=request_password" method='post' enctype='multipart/form-data'>
<input type='hidden' name='formmail_submit' value='Y'>
<br><br><br>

<center>
<div style="width:580px;height:260px;text-align:left;">
<fieldset style="padding:18px;" >
<legend>Request Password</legend>
Enter Email Address <b><?php echo strtoupper($email) ;?></b>:<br />
<input type="text" name="Username"  value="<?php echo $_POST['Username']; ?>" style="width:380px;">
<input type='submit' value='Verify'><br>
The password will be sent to this email address. 
<?php if( $sErr ) echo "<br /><br /><span style='color:red;font-weight:bold;'>{$sErr}</span><br><br>\n"; ?>
</fieldset>
</div>
<script type="text/javascript">
    document.frmRequestPassword.Username.focus();
</script>
</form>
<?php
    phpfmg_admin_footer();    
}


function phpfmg_mail_password(){
    phpfmg_admin_header();
    if( defined( 'PHPFMG_USER' ) && defined( 'PHPFMG_PW' ) ){
        $body = "Here is the password for your form admin panel:\n\nUsername: " . PHPFMG_USER . "\nPassword: " . PHPFMG_PW . "\n\n" ;
        if( 'html' == PHPFMG_MAIL_TYPE )
            $body = nl2br($body);
        mailAttachments( PHPFMG_USER, "Password for Your Form Admin Panel", $body, PHPFMG_USER, 'You', "You <" . PHPFMG_USER . ">" );
        echo "<center>Your password has been sent.<br><br><a href='admin.php'>Click here to login again</a></center>";
    };   
    phpfmg_admin_footer();
}


function phpfmg_writable_check(){
 
    if( is_writable( dirname(PHPFMG_SAVE_FILE) ) && is_writable( dirname(PHPFMG_EMAILS_LOGFILE) )  ){
        return ;
    };
?>
<style type="text/css">
    .fmg_warning{
        background-color: #F4F6E5;
        border: 1px dashed #ff0000;
        padding: 16px;
        color : black;
        margin: 10px;
        line-height: 180%;
        width:80%;
    }
    
    .fmg_warning_title{
        font-weight: bold;
    }

</style>
<br><br>
<div class="fmg_warning">
    <div class="fmg_warning_title">Your form data or email traffic log is NOT saving.</div>
    The form data (<?php echo PHPFMG_SAVE_FILE ?>) and email traffic log (<?php echo PHPFMG_EMAILS_LOGFILE?>) will be created automatically when the form is submitted. 
    However, the script doesn't have writable permission to create those files. In order to save your valuable information, please set the directory to writable.
     If you don't know how to do it, please ask for help from your web Administrator or Technical Support of your hosting company.   
</div>
<br><br>
<?php
}


function phpfmg_log_view(){
    $n = isset($_REQUEST['file'])  ? $_REQUEST['file']  : '';
    $files = array(
        1 => PHPFMG_EMAILS_LOGFILE,
        2 => PHPFMG_SAVE_FILE,
    );
    
    phpfmg_admin_header();
   
    $file = $files[$n];
    if( is_file($file) ){
        if( 1== $n ){
            echo "<pre>\n";
            echo join("",file($file) );
            echo "</pre>\n";
        }else{
            $man = new phpfmgDataManager();
            $man->displayRecords();
        };
     

    }else{
        echo "<b>No form data found.</b>";
    };
    phpfmg_admin_footer();
}


function phpfmg_log_download(){
    $n = isset($_REQUEST['file'])  ? $_REQUEST['file']  : '';
    $files = array(
        1 => PHPFMG_EMAILS_LOGFILE,
        2 => PHPFMG_SAVE_FILE,
    );

    $file = $files[$n];
    if( is_file($file) ){
        phpfmg_util_download( $file, PHPFMG_SAVE_FILE == $file ? 'form-data.csv' : 'email-traffics.txt', true, 1 ); // skip the first line
    }else{
        phpfmg_admin_header();
        echo "<b>No email traffic log found.</b>";
        phpfmg_admin_footer();
    };

}


function phpfmg_log_delete(){
    $n = isset($_REQUEST['file'])  ? $_REQUEST['file']  : '';
    $files = array(
        1 => PHPFMG_EMAILS_LOGFILE,
        2 => PHPFMG_SAVE_FILE,
    );
    phpfmg_admin_header();

    $file = $files[$n];
    if( is_file($file) ){
        echo unlink($file) ? "It has been deleted!" : "Failed to delete!" ;
    };
    phpfmg_admin_footer();
}


function phpfmg_util_download($file, $filename='', $toCSV = false, $skipN = 0 ){
    if (!is_file($file)) return false ;

    set_time_limit(0);


    $buffer = "";
    $i = 0 ;
    $fp = @fopen($file, 'rb');
    while( !feof($fp)) { 
        $i ++ ;
        $line = fgets($fp);
        if($i > $skipN){ // skip lines
            if( $toCSV ){ 
              $line = str_replace( chr(0x09), ',', $line );
              $buffer .= phpfmg_data2record( $line, false );
            }else{
                $buffer .= $line;
            };
        }; 
    }; 
    fclose ($fp);
  

    
    /*
        If the Content-Length is NOT THE SAME SIZE as the real conent output, Windows+IIS might be hung!!
    */
    $len = strlen($buffer);
    $filename = basename( '' == $filename ? $file : $filename );
    $file_extension = strtolower(substr(strrchr($filename,"."),1));

    switch( $file_extension ) {
        case "pdf": $ctype="application/pdf"; break;
        case "exe": $ctype="application/octet-stream"; break;
        case "zip": $ctype="application/zip"; break;
        case "doc": $ctype="application/msword"; break;
        case "xls": $ctype="application/vnd.ms-excel"; break;
        case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
        case "gif": $ctype="image/gif"; break;
        case "png": $ctype="image/png"; break;
        case "jpeg":
        case "jpg": $ctype="image/jpg"; break;
        case "mp3": $ctype="audio/mpeg"; break;
        case "wav": $ctype="audio/x-wav"; break;
        case "mpeg":
        case "mpg":
        case "mpe": $ctype="video/mpeg"; break;
        case "mov": $ctype="video/quicktime"; break;
        case "avi": $ctype="video/x-msvideo"; break;
        //The following are for extensions that shouldn't be downloaded (sensitive stuff, like php files)
        case "php":
        case "htm":
        case "html": 
                $ctype="text/plain"; break;
        default: 
            $ctype="application/x-download";
    }
                                            

    //Begin writing headers
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: public"); 
    header("Content-Description: File Transfer");
    //Use the switch-generated Content-Type
    header("Content-Type: $ctype");
    //Force the download
    header("Content-Disposition: attachment; filename=".$filename.";" );
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: ".$len);
    
    while (@ob_end_clean()); // no output buffering !
    flush();
    echo $buffer ;
    
    return true;
 
    
}
?>