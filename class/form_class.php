<?php

Class Form{

	public function text($id,$name,$label,$placeholder,$required = null){

        return "<div class=\"form-group $required\">
              <label for=\"$name\">$label</label>
              <input $required type=\"text\" id=\"$id\" class=\"form-control\" placeholder=\"$placeholder\" name=\"$name\">
              </div>";
	}
	public function email($id,$name,$label,$placeholder, $required = null){

        return "<div class=\"form-group $required\">
              <label for=\"$name\">$label</label>
              <input $required type=\"email\" id=\"$id\" class=\"form-control\" placeholder=\"$placeholder\" name=\"$name\">
              </div>";
	}


} // FIN DE LA CLASSE FORM
?>