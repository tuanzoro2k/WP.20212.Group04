<?php 
class Routes{
    var $array = [];
    function handleUrl($url){
       global $Routes;
       $returnUrl = ltrim($url,'/');
       if (isset($Routes))
       {
            $folder = $this->readFolder('mvc/controllers');
            $strpos = $this->checkUrl($returnUrl,$folder);
            foreach($Routes as $key => $val){
                $paramer = explode('/',$val);
                $urlArray = explode('/', ltrim($url,'/'));
                if ($strpos === 0  && $url !== '/') {
                    $regex = $this->convertRegex($key);
                    if (preg_match($regex,$returnUrl))
                    {
                        unset($paramer[count($paramer) - 1]);
                        $explode_url = explode('/',$returnUrl);
                        $returnUrl = preg_replace('~'.$regex.'~is',$val,$explode_url[count($explode_url) - 1]);
                        $strip = '';
                        foreach($paramer as $value){
                           $strip .= $value.'/';
                        }
                        $ltrim = trim($strip,'/');
                        $strip = $strip.$returnUrl;
                        $returnUrl = $strip;
                    }
                }
                else{
                    if (count($urlArray) < 2) {
                        if (preg_match('~'.$key.'~is',$url))
                        {
                            $returnUrl = preg_replace('~'.$key.'~is',$url,$val);
                        }
                    }
                }
            }
       }
       return $returnUrl;
    }
    function checkUrl($url, $folder = NULL){
        $trim = ltrim($url,'/');
        $countArray = explode('/',$trim);
        $counts = 0;
        $urlString = '';
        foreach($folder as $key => $value){
            foreach($countArray as $val){
                $urlString .= $val.'/';
                $filecheck = trim($urlString,'/');
                if (file_exists('mvc/controllers/'.$filecheck.'.php'))
                {
                    $counts = 1;
                    break;
                }
            }
        }
        return $counts;
    }
    function convertRegex($string){
        if (preg_match('(:any)', $string)) {
            return '/([a-zA-Z0-9]+)/';
        }
        else if(preg_match('(:num)', $string)){
            return '/^[0-9]+$/i';
        }
    }
    function readFolder($folder_ = NULL){
        if (is_dir($folder_)) {
            $folder = glob($folder_.'/*');
            foreach($folder as $value){
                if (is_dir($value)) {
                    $this->readFolder($value);
                }
                else
                {
                   array_push($this->array, explode('.',$value)[0]);
                }
            }
        }
        return $this->array;
    }
}