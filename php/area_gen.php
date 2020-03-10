<?php
/**
 * Created by PhpStorm.
 * User: denco
 * Date: 21.12.2018
 * Time: 19:56
 */

class area_gen
{
    //public $field = 0;
    public $attr = array(

        'required' => false,//false
        'multiple' => NULL,
        'disabled' => NULL,

        'type' => 'text',//''


        'size' => NULL,
        'option_count' => NULL,
    );

    public function __construct($a = false)
    {
        if ($a != false) $a = true;
        $this->attr['required'] = $a;
    }

    public function set_p($attr, $weight)
    {
        $this->attr[$attr] = $weight;
    }

    public function default()
    {
        $this->attr['required'] = 0;
        $this->attr['multiple'] = NULL;
        $this->attr['disabled'] = NULL;


        $this->attr['type'] = 'text';


        $this->attr['size'] = NULL;
        $this->attr['option_count'] = NULL;

    }

    public function get_p($attrib)
    {
        return $this->attr[$attrib];
    }

    public function make_input_echo($name, $placeholder = NULL, $pattern = NULL, $value = NULL)
    {

        $attr = $this->attr;

        echo '<input ';
        echo 'name=' . $name . ' ';
        if ($attr['required'] != 0) echo "required ";

        //if ($attr['name'] != NULL) echo "name='" . $attr['name'] . "' ";
        //else

        if ($value != NULL) echo 'value="' . $value . '" ';

        if ($placeholder != NULL) echo 'placeholder="' . $placeholder . '" ';

        if ($pattern != NULL) echo 'pattern="' . $pattern . '" ';

        if ($attr['type'] != NULL) echo "type='" . $attr['type'] . "' ";
        else echo 'type="text" ';

        if ($attr['size'] != NULL) echo "size='" . $attr['size'] . "' ";
        echo '>';
    }

    public function make_hidden($name,$value){
        echo "<input type='hidden' name='$name' value='$value'>";
    }

    public function make_select_echo($opt, $name, $selected=NULL,$key=false) {

        $attr = $this->attr;
        //$a=array_keys($opt);
        //var_dump($opt);
        echo '<select ';
        echo "name='$name' ";
        if ($attr['multiple'] != NULL) echo "multiple ";

        if ($attr['placeholder'] != NULL) echo 'placeholder="' . $attr['placeholder'] . '"';

        if ($attr['size'] != NULL) echo 'size="' . $attr['size'] . '"';
        echo ' >';
        $a = count($opt);
        if ($selected != NULL) echo '<option selected disabled>'. $selected. '</option> ';
//        for ($i = -1; $i < $a; $i++) {
//
//            echo '<option value="'.$i.'">' . $opt[$i] . '</option>';
//        }
        if ($key){
        foreach ($opt as $i=>$var){
            echo '<option value="'.$i.'">' . $var . '</option>';
        }
        }
        else{
            foreach ($opt as $i=>$var){
                echo '<option value="'.$var.'">' . $var . '</option>';
            }
        }

        echo '</select>';
    }
}
//
//    }
//
//    public function make_textarea_echo() {
//
//    }
//
//}

//<input type="text" name="username_reg" required pattern="[a-zA-Z0-9]{5,20}">
 //

//if ($attr['required']!=NULL) echo "";
//if ($attr['multiple']!=NULL) echo "";
//if ($attr['disabled']!=NULL) echo "";
//
//if ($attr['type']!=NULL) echo "";
//if ($attr['name']!=NULL) echo "";
//if ($attr['value']!=NULL) echo "";
//if ($attr['placeholder']!=NULL) echo "";
//
//if ($attr['size']!=NULL) echo "";
//if ($attr['option_count']!=NULL) echo "";