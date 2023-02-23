<?php
    class harmony extends Plugin {
     



    public function adminView()
    {

        global $security;
        $tokenCSRF = $security->getTokenCSRF();


    if(isset($_GET['editharmony'])){
        include($this->phpPath().'php/makeHarmony.php');
    }elseif(isset($_GET['addHarmony'])){
        include($this->phpPath().'php/makeHarmony.php');
    }elseif(isset($_GET['helpHarmony'])){
        include($this->phpPath().'php/helpHarmony.php');
    }else{
        include($this->phpPath().'php/accordionList.php');
    }


    echo '
    
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank" style="box-sizing:border-box;display:grid; width:100%;grid-template-columns:1fr auto; padding:10px;background:#fafafa;border:solid 1px #ddd;margin-top:20px;">
    <p style="margin:0;padding:0;"> If you like use my plugin! Buy me ☕ </p>
    <input type="hidden" name="cmd" value="_s-xclick">
    <input type="hidden" name="hosted_button_id" value="KFZ9MCBUKB7GL">
    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" border="0">
    <img alt="" src="https://www.paypal.com/en_PL/i/scr/pixel.gif" width="1" height="1" border="0">
</form>
';

    }


    public function adminController()
    {


        if(isset($_POST['createHarmony'])){
            $newJson = [];
            $newJson['harmonyTitle'] = @$_POST['harmonyTitle'];
            $newJson['harmonyContent'] = @$_POST['harmonyContent'];
            $newJson['style'] = $_POST['style'];
            $newJsonContent = json_encode($newJson);
            file_put_contents($this->phpPath().'harmonydb/'.$_POST['title'].'.json',$newJsonContent);
        };


        if(isset($_GET['deleteharmony'])){

            unlink($this->phpPath().'harmonydb/'.$_GET['deleteharmony'].'.json');

        }


    }


        public function adminSidebar()
        {
            $pluginName = Text::lowercase(__CLASS__);
            $url = HTML_PATH_ADMIN_ROOT.'plugin/'.$pluginName;
            $html = '<a id="current-version" class="nav-link" href="'.$url.'">🪗 Harmony Settings</a>';
            return $html;
        }


        public function pageBegin()
        {
    
            global $page;
    
            $newcontent = preg_replace_callback(
                '/\\[% harmony=(.*) %\\]/i',
                "harmonyShow",
                $page->content()
            );
    
    
            global $page;
            $page->setField('content', $newcontent);
        }
    
        public function siteHead(){
        echo '	<link rel="stylesheet" type="text/css" href="'.$this->domainPath().'css/harmony-accordion.css">';
        echo '	<link rel="stylesheet" type="text/css" href="'.$this->domainPath().'css/harmony-tab.css">';
        }


        public function siteBodyEnd(){
            echo '<script src="'.$this->htmlPath().'js/harmony-accordion.js"></script>';
            echo '<script src="'.$this->htmlPath().'js/harmony-tab.js"></script>';
        }

    }


    function harmonyShow($name){

        $modules = array();
        $name = $name[1];
        $data = file_get_contents(PATH_PLUGINS . 'harmony/harmonydb/' . $name . '.json');
        $dataJson = json_decode($data, false);

        $style = $dataJson->style;  

        $harmonyShows = '';


if($style == 'tabs'){
include(PATH_PLUGINS.'harmony/php/tabs.php');
 };

 if($style == 'accordion'){
    include(PATH_PLUGINS.'harmony/php/accordion.php');
     };

      if($style == 'harmony-accordion'){
    include(PATH_PLUGINS.'harmony/php/harmony-accordion.php');
     };

      if($style == 'harmony-tabs'){
    include(PATH_PLUGINS.'harmony/php/harmony-tabs.php');
     };
return $harmonyShows;

}

?>