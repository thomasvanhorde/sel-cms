<?php
/**
 * User: Thomas
 * Date: 11 déc. 2010
 * Time: 17:01:03
 */


/* todo: cache system */

if(file_exists(FOLDER_CLASS_EXT.'Css_compressor.class.php'))
	require_once FOLDER_CLASS_EXT.'Css_compressor.class.php';
elseif(file_exists(ENGINE_URL.FOLDER_CLASS_EXT.'Css_compressor.class.php'))
	require_once ENGINE_URL.FOLDER_CLASS_EXT.'Css_compressor.class.php';
else
    Base::Load(CLASS_CORE_MESSAGE)->Critic('ERR_LOAD_CLASS_CSS_COMPRESSOR');


class Css {


    const CssFolder = 'themes/package/';
    const CssPackageFolder = '../';
        
    const Small = 'Sm';
    const None = 'None';
    const Large = 'Lg';
    const XLarge = 'Xl';
    const XXLarge = 'Xxl';
    const TextAlign = 'txt';
    const Flote = 'float';  // mot reservé ?
    const Auto = 'Auto';
    const Left = 'L';
    const Right = 'R';
    const Center = 'C';
    const Top = 'T';
    const Bottom = 'B';
    const Padding = 'padding';
    const Margin = 'margin';
    const Border = 'border';
    const Align = 'align';
    const Majuscule = 'maj';
    const Underline = 'underline';
    const Font = 'txt';
    const BackgroundColor = 'bkg';
    const OtherClear = 'clear';
    const OtherContext = 'context';
    const OtherBlk = 'blk';
    const OtherBlkL = 'blkL';
    const Colors = 'Red|Blue|Cyan|Yellow|Brown|Purple|Orange|Black|Green|Gray|Aqua|Navy|Olive|Fuchsia|Silver|Teal|Lime';
    const BorderStyle = 'Solid|Dotted|Dashed|Inset|Outset';
    const TxtStyle = 'oblique|italic|normal';
    const TxtWeight = 'bold';
    const Hexa = '#';
    
    const _Px = 'px';
    const _End = ';';
    const _Important = '!important';
    const _Separator = "";

    const DEFAUT_margin = 10;
    const DEFAUT_padding = 10;
    const DEFAUT_border = 1;
    const DEFAUT_borderStyle = 'Solid';
    const DEFAUT_borderColor = 'black';
    
    const VAL_Auto = 'auto';
    const VAL_None = 0;
    const VAL_Sm = 5;
    const VAL_Lg = 20;
    const VAL_Xl = 40;
    const VAL_Xxl = 100;
    
    private $_uniqId;
    private $_css;
    private $_document;
    private $_cssFile;
    private $_compressor;
    private $_sys_folder;

    function __construct($uniqId = false){
        $this->_sys_folder = SYS_FOLDER;
        if($uniqId)
            $this->_uniqId = $uniqId;
        else
            $this->_uniqId = $this->generateUniqId();
        $this->_css = '';
        $this->_cssFile = self::CssFolder.$this->_uniqId.'.css';
    }

    private function getCssFile(){
        return $this->_cssFile;
    }
    
    private function getVal($const) {
        eval('$value = '.get_class($this).'::VAL_'.$const.';');
        return $value;
    }
    
    private function generateUniqId(){
        $tmp = urlencode(base64_encode($_SERVER['PHP_SELF']));
        return str_replace('%','',$tmp);
    }

    function getUniqId(){
        return $this->_uniqId;   
    }

    function LoadHTML($buffer){

        $dom = DOMImplementation::createDocument(null, 'html',
            DOMImplementation::createDocumentType("html",
                "-//W3C//DTD XHTML 1.0 Transitional//EN",
                "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"));
        
        $dom->formatOutput = true;
        $dom->preserveWhiteSpace = false;
        $dom->validateOnParse = true;
        $dom->normalize();
        /*** load the html into the object ***/
        $dom->loadHTML($buffer);
        
        $this->_document = &$dom;
    }

    function getStyleSheet(){
        $dom = $this->_document;
        $node = $dom->getElementsByTagname('link');
        $nb = $node->length;
        $urlStyleSheet = array();
        for ($i = 0; $i <= ($nb-1); $i++) {
            $urlStyleSheet[] = $node->item(0)->getAttribute('href');
            $this->getHead()->removeChild($node->item(0));
        }

        return $urlStyleSheet;
    }

    private function getHead(){
        $dom = $this->_document;
        return $head = $dom->getElementsByTagname('head')->item(0);
    }

    function compactStyleSheet(){
        $dom = $this->_document;

        if(CSS_COMPRESSOR){
            $urlStyleSheet = $this->getStyleSheet();
            $this->getCssExternal($urlStyleSheet);
            $this->replaceUrlBackground();
        }

        $cssGenerate = $this->generateCss();
        
        $this->SaveCssFile();
        $this->AddCssUrl();
 //       print_r($urlStyleSheet);
    }

    private function replaceUrlBackground(){
        $this->_css = str_replace("url('", "url('".self::CssPackageFolder, $this->_css);
        $this->_css = str_replace('url("', 'url("'.self::CssPackageFolder, $this->_css);
    }

    private function getCssExternal($urlStyleSheet){
        if(is_array($urlStyleSheet) && count($urlStyleSheet) > 0){
            foreach($urlStyleSheet as $file){
                $handle = fopen($_SERVER['DOCUMENT_ROOT'].$file, "rb");
                $contents = stream_get_contents($handle);
                fclose($handle);
                $this->_css .= $contents;
            }
        }
    }

    private function AddCssUrl(){
        if(!empty($this->_css)){    // If empty no replace
            $dom = $this->_document;
            $element = $dom->createElement('link');
            $element->setAttribute('href', $this->_sys_folder.$this->getCssFile());
            $element->setAttribute('type', 'text/css');
            $element->setAttribute('media', 'screen');
            $element->setAttribute('rel', 'stylesheet');
            $this->getHead()->appendChild($element);
        }
    }

    private function getCss(){
        return Minify_CSS_Compressor::process($this->_css);
    }

    private function SaveCssFile(){
        if(!empty($this->_css)){    // If empty = no generate
            $file = fopen($this->getCssFile(), 'w+');
            fseek($file, 0);
            fputs($file, $this->getCss());
            fclose($file);
        }
    }

    public function display(){
        $html = $this->_document->saveXML();
        echo html_entity_decode($html,ENT_QUOTES,"UTF-8");
    }


    function exportHTML($file = 'outpout.html'){
        $html = $this->_document->saveHTML();
        $file = fopen($file, 'w+');
        fseek($file, 0);
        fputs($file, $html);
        fclose($file);
    }

    function getClass($cache = true){
        $dom = $this->_document;
        /*** the table by its tag name ***/
        $tables = $dom->getElementsByTagName('*');
        $classTmp = $classTmp2 = array();
        $class = array();
        /*** loop over the table rows ***/
        foreach ($tables as $row) {
            $cList = $row->getAttribute('class');
            if(!empty($cList)){
                $cListArray = explode(' ',$cList);
                foreach($cListArray as $c)
                    array_push($classTmp, $c);
            }
        }

        foreach($classTmp as $c)
            $classTmp2[$c] = null;
        foreach($classTmp2 as $c => $v)
            array_push($class, $c);

        usort($class, 'strcasecmp');
        return $class;
    }

    function generateCss(){
        $classss = $this->getClass();

        foreach($classss as $class){
            $content = '';

            if(empty($content)) $content = $this->genUnderline($class);
            if(empty($content)) $content = $this->genMajuscule($class);
            if(empty($content)) $content = $this->genBlk($class);
            if(empty($content)) $content = $this->genBlkL($class);
            if(empty($content)) $content = $this->genClear($class);
            if(empty($content)) $content = $this->genContext($class);
            if(empty($content)) $content = $this->genTxtStyle($class);
            if(empty($content)) $content = $this->genTxtWeight($class);
            if(empty($content)) $content = $this->genFloat($class);
            if(empty($content)) $content = $this->genMargin($class);
            if(empty($content)) $content = $this->genPadding($class);
            if(empty($content)) $content = $this->genTxt($class);
            if(empty($content)) $content = $this->genBackground($class);
            if(empty($content)) $content = $this->genBorder($class);

            if(!empty($content)){
                $this->_css .= '.';
                $this->_css .= $class;
                $this->_css .= '{';
                $this->_css .= $content;
                $this->_css .= self::_Important;
                $this->_css .= self::_End;
                $this->_css .= '}';
                $this->_css .= "\n";
            }
        }

        return $this->_css;
    }

    private function genMajuscule($className){
        if(preg_match('/^'.self::Majuscule.'$/', $className, $matches))
            return 'text-transform:uppercase';
    }

    private function genUnderline($className){
        if(preg_match('/^'.self::Underline.'$/', $className, $matches))
            return 'text-decoration:underline';
    }

    private function genBlk($className){
        if(preg_match('/^'.self::OtherBlk.'$/', $className, $matches))
            return 'display:block';
    }

    private function genClear($className){
        if(preg_match('/^'.self::OtherClear.'$/', $className, $matches))
            return 'clear:both';
    }

    private function genBlkL($className){
        if(preg_match('/^'.self::OtherBlkL.'$/', $className, $matches))
            return 'display:inline-block';
    }

    private function genContext($className){
        if(preg_match('/^'.self::OtherContext.'$/', $className, $matches))
            return 'overflow:hidden;_overflow:visible;zoom:1';
    }

    private function genTxtStyle($className){
        if(preg_match('/'.self::TxtStyle.'/', $className, $matches))
            return 'font-style:'.current($matches);
    }

    private function genTxtWeight($className){
        if(preg_match('/'.self::TxtWeight.'/', $className, $matches))
            return 'font-weight:'.current($matches);
    }

    private function genNumber($className){
        $pattern = '/[0-9]+[0-9]+[0-9]|[0-9]+[0-9]|[0-9]/';
        if(preg_match($pattern, $className, $matches))
            return current($matches);
    }

    private function genMesureLabel($className){
        $pattern = '/'.self::Small.'|'.self::Large.'|'.self::XLarge.'|'.self::XXLarge.'|'.self::None.'/';
        if(preg_match($pattern, $className, $matches)){
            if(!empty($matches))
                return $this->getVal(current($matches));
        }
    }

    private function genTop($className){
        $pattern = '/^'.self::Top.'/';
        if(preg_match($pattern, $className, $matches))
            return 'top';
    }

    private function genAuto($className){
        $pattern = '/'.self::Auto.'/';
        if(preg_match($pattern, $className, $matches))
            return 'auto';
    }

    private function genBottom($className){
        $pattern = '/^'.self::Bottom.'/';
        if(preg_match($pattern, $className, $matches))
            return 'bottom';
    }

    private function genRight($className){
        $pattern = '/'.self::Right.'/';
        if(preg_match($pattern, $className, $matches))
            return 'right';
    }

    private function genLeft($className){
        $pattern = '/'.self::Left.'/';
        if(preg_match($pattern, $className, $matches))
            return 'left';
    }

    private function genCenter($className){
        $pattern = '/'.self::Center.'/';
        if(preg_match($pattern, $className, $matches))
            return 'center';
    }


    private function genTxt($className){
        $pattern = '/^'.self::Font.'/';
        $return = '';
        if(preg_match($pattern, $className, $matches)){
            // Colors string
            if(empty($return) && preg_match('/'.self::Colors.'^/', $className, $matches))
                $return .= 'color:'.strtolower(current($matches));

            // Colors hexa
            if(empty($return) && preg_match('/'.self::Font.'+[a-zA-Z0-9]{6}|'.self::Font.'+[a-zA-Z0-9]{3}/', $className, $matches))
                $return .= 'color:'.self::Hexa.strtolower(str_replace(self::Font,'',current($matches)));

            // Txt Size
            if(empty($return) && preg_match('/[0-9]+[0-9]$|[0-9]$/', $className, $matches))
                $return .= 'font-size:'.(current($matches) / 10).'em';

            if(empty($return)){ // L R C
                $pos = $this->genLeft($className);
                if(empty($pos))
                    $pos = $this->genRight($className);
                if(empty($pos))
                    $pos = $this->genCenter($className);

                $return .= 'text-align:'.$pos;
            }

        }
        return $return;
    }

    private function genBackground($className){
        $pattern = '/^'.self::BackgroundColor.'/';
        $return = '';
        if(preg_match($pattern, $className, $matches)){
            // Colors string
            if(empty($return) && preg_match('/'.self::Colors.'^/', $className, $matches))
                $return .= 'background-color:'.strtolower(current($matches));

            // Colors hexa
            if(empty($return) && preg_match('/'.self::BackgroundColor.'+[a-zA-Z0-9]{6}|'.self::BackgroundColor.'+[a-zA-Z0-9]{3}/', $className, $matches))
                $return .= 'background-color:'.self::Hexa.strtolower(str_replace(self::BackgroundColor,'',current($matches)));
        }
        return $return;
    }

    private function genBorder($className){
        $pattern = '/'.self::Border.'/';
        $return = '';
        if(preg_match($pattern, $className, $matches)){
            $return .= 'border';
            $pos = $this->genLeft($className);
            if(empty($pos))
                $pos = $this->genRight($className);
            if(empty($pos))
                $pos = $this->genTop($className);
            if(empty($pos))
               $pos = $this->genBottom($className);
            if(!empty($pos))
                $return .= '-'.$pos;

            $return .= ':';
            $mesureNumber = $this->genNumber($className);
            $mesureLabel = $this->genMesureLabel($className);
            $mesureAuto = $this->genAuto($className);

            if(empty($mesureAuto)){
                if(!empty($mesureNumber))
                    $return .= $mesureNumber;
                elseif(!empty($mesureLabel))
                    $return .= $mesureLabel;
                else
                    $return .= self::DEFAUT_border;
                $return .= self::_Px;
            }
            else
                $return .= self::VAL_Auto;

            if(preg_match('/'.self::BorderStyle.'^/', $className, $matches))
                $style = current($matches);
            else
                $style = self::DEFAUT_borderStyle;

            $return .= ' '.strtolower($style);

            if(preg_match('/'.self::Colors.'/', $className, $matches))
                $color = strtolower(current($matches));
            // Colors hexa
            if(empty($color) && preg_match('/'.$style.'+[a-zA-Z0-9]{6}|'.$style.'+[a-zA-Z0-9]{3}/', $className, $matches))
                $color = self::Hexa.strtolower(str_replace($style,'',current($matches)));
            if(empty($color))
                $color = self::DEFAUT_borderColor;

            $return .= ' '.$color;

        }
        return $return;
    }

    private function genMargin($className){
        $pattern = '/'.self::Margin.'/';
        $return = '';
        if(preg_match($pattern, $className, $matches)){
            $return .= 'margin';
            $pos = $this->genLeft($className);
            if(empty($pos))
                $pos = $this->genRight($className);
            if(empty($pos))
                $pos = $this->genTop($className);
            if(empty($pos))
               $pos = $this->genBottom($className);
            if(!empty($pos))
                $return .= '-'.$pos;

            $return .= ':';
            $mesureNumber = $this->genNumber($className);
            $mesureLabel = $this->genMesureLabel($className);
            $mesureAuto = $this->genAuto($className);
            if(empty($mesureAuto)){
                if(!empty($mesureNumber))
                    $return .= $mesureNumber;
                if(!empty($mesureLabel) || $mesureLabel == 0)
                    $return .= $mesureLabel;
                if(empty($mesureNumber) && empty($mesureLabel) && $mesureLabel != 0)
                    $return .= self::DEFAUT_margin;
                if(empty($mesureNumber))
                    $return .= self::DEFAUT_margin;

                $return .= self::_Px;
            }
            else
                $return .= self::VAL_Auto;
        }
        return $return;
    }

    private function genPadding($className){
        $pattern = '/'.self::Padding.'/';
        $return = '';
        if(preg_match($pattern, $className, $matches)){
            $return .= 'padding';
            $pos = $this->genLeft($className);
            if(empty($pos))
                $pos = $this->genRight($className);
            if(empty($pos))
                $pos = $this->genTop($className);
            if(empty($pos))
               $pos = $this->genBottom($className);
            if(!empty($pos))
                $return .= '-'.$pos;

            $return .= ':';
            $mesureNumber = $this->genNumber($className);
            $mesureLabel = $this->genMesureLabel($className);
            $mesureAuto = $this->genAuto($className);

            if(empty($mesureAuto)){
                if(!empty($mesureNumber))
                    $return .= $mesureNumber;
                if(!empty($mesureLabel) || $mesureLabel == 0)
                    $return .= $mesureLabel;
                if(empty($mesureNumber) && empty($mesureLabel) && $mesureLabel != 0)
                    $return .= self::DEFAUT_padding;
                if(empty($mesureNumber))
                    $return .= self::DEFAUT_padding;

                $return .= self::_Px;
            }
            else
                $return .= self::VAL_Auto;
        }
        return $return;
    }

    private function genFloat($className){
        $pattern = '/^'.self::Flote.'/';
        $return = '';
        if(preg_match($pattern, $className, $matches)){
            $return .= 'float:';
            $return .= $this->genLeft($className);
            $return .= $this->genRight($className);
        }
        return $return;
    }

}
