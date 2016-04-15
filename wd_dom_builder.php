<?php

class WD_elements {
    
    private $tag; 
    
    function openForm($formAction = '#', $name=NULL, $formMethod = 'post', $attributes = array() ) {

        $tag = "<form action=\"$formAction\" method=\"$formMethod\" name=\"$name\""; 

        $tag .= $attributes? $this->setAttributes( $attributes ) . '>': '>';

        return $tag;
    } 

    function inputType($type=NULL, $name=NULL, $value=NULL, $attributes = array() ) { 

        $label = ''; $req = isset($attributes['req']) ? $attributes['req'] : ''; 

        if(!in_array($type, array("button", "submit"))){

            $labelText = isset($attributes['label']) ? $attributes['label'] : ucfirst($name);

                $label = $this->setLabel($labelText);
               
                unset($attributes['label']);
                unset($attributes['req']);
        }

        $nameAttr = substr($name, 0, -2);
        $tag = $label.'<input type="'.$type.'" name="'.$name.'" value="'.$value.'"';
        if ($attributes) {
            $tag .= $this->setAttributes( $attributes );
        }
        $tag .= '>';

        if($type == 'checkbox') {
            if($req == 'req' && @$_REQUEST[$nameAttr] == '' && strtoupper($_SERVER['REQUEST_METHOD']) == 'POST' ){
                     $tag .= $this->setErrorLabel($nameAttr);
            }
        } else       

        if( $req == 'req' && strtoupper($_SERVER['REQUEST_METHOD']) == 'POST' && @$_REQUEST[$name] == '' ){  
                $tag .= $this->setErrorLabel($name);
        }       


        $tag = $this->tagGroup($tag);
        return $tag;
    }
    
    function setTextarea($name=NULL, $value = '', $attributes = array() ) {

        $rowsCols = ' rows = "4" cols = "30" ';

        $req = isset($attributes['req']) ? $attributes['req'] : '';

        $labelText = isset($attributes['label']) ? $attributes['label'] : ucfirst($name);
        $label = $this->setLabel($labelText);
        unset($attributes['label']);

        $tag = $label."<textarea name=\"$name\"  $rowsCols ";

        if ($attributes) {
            $tag .= $this->setAttributes( $attributes );
        }
        $tag .= ">$value</textarea>";

        if( $req == 'req' && isset($_REQUEST[$name]) && ($_REQUEST[$name] == '' || $_REQUEST[$name] == NULL) ){ 
             $tag .= $this->setErrorLabel($name); 
        }

        $tag = $this->tagGroup($tag);
        return $tag;
    } 

    function selectBox($name=NULL, $options_list=NULL, $attributes = array() ) {

        $labelText = isset($attributes['label']) ? $attributes['label'] : ucfirst($name);

        $req = isset($attributes['req']) ? $attributes['req'] : '';

        $select = $this->setLabel($labelText);
        unset($attributes['label']);        

        $select .= "<select name=\"$name\" ";

        if ($attributes) {
            $select .= $this->setAttributes( $attributes );
        }

        $select .= " >";

        foreach ( $options_list as $val => $option ) {

            $selected = in_array($val, $attributes) ? " selected=\"selected\" ": " ";

             $select .= "\n<option value=\"$val\" $selected >".$option."</option>"; 
        }
        $select .= "\n</select>";

        if( $req == 'req' && isset($_REQUEST[$name]) && ($_REQUEST[$name] == '' || $_REQUEST[$name] == NULL) ){ 
             $select .= $this->setErrorLabel($name); 
        }

        $select = $this->tagGroup($select);
        return ($select);
    }
    
    function tagGroup($tags) { 
        $form_elem = "<div class=\"form-group\" >".$tags."</div >"; 
        return $form_elem;
    }  

    function setLabel($label_text) { 
        $label = '<label class="wdf-label">'.$label_text.'</label>'; 
        return $label;
    } 

    function setErrorLabel($name) { 
        $tag = "<small class=\"errorText\"> ".$name." field is required</small>";
        return $tag;
    }        


    function groupTitle($title){

        $group_title = '<h3 class="grp-title">'.$title.'</h3>'; 
        return $group_title;
    }

    private function setAttributes( $attributes ) {

        $attr = ''; 

        foreach( $attributes as $key=>$val ) { 
                $attr .=  $key.'="'.$val.'" '; 
        }
        return $attr;
    }

    function closeForm() { 

        return "</form>";
    }      
    
}

?>
