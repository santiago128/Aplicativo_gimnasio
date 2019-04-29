<?php 
class type_disease{

private $name_disease;
private $name_disease2;
private $state_disease;

public function __GET($k){return $this->$k;}
public function __SET($k,$v){return $this->$k=$v;}
}
 
class type_people{

private $n_document;
private $n_document2;
private $type_document_people;
private $type_document_people2;
private $first_name;
private $second_name;
private $first_lastname;
private $second_lastname;
private $birth_date;
private $age;
private $address;
private $number_phone;
private $email;
private $rol_user;
private $routines_user;

public function __GET($k){return $this->$k;}
public function __SET($k,$v){return $this->$k=$v;}
}
class type_role{

private $name_rol;
private $name_rol2;
private $state_rol;

public function __GET($k){return $this->$k;}
public function __SET($k,$v){return $this->$k=$v;}
}
class type_rutina{

private $code_routine;
private $code_routine2;
private $desc_routine;

public function __GET($k){return $this->$k;}
public function __SET($k,$v){return $this->$k=$v;}
}
class type_document{

private $code_document;
private $code_document2;
private $desc_document;

public function __GET($k){return $this->$k;}
public function __SET($k,$v){return $this->$k=$v;}
}
class type_history{

private $cod_history;
private $cod_history2;
private $date_history;
private $user_n_document;
private $user_type_document;
private $disease;


public function __GET($k){return $this->$k;}
public function __SET($k,$v){return $this->$k=$v;}
}
class type_machines{

private $name_maq;
private $name_maq2;
private $state_mac;


public function __GET($k){return $this->$k;}
public function __SET($k,$v){return $this->$k=$v;}
}
class type_exercise{
	
private $name_ejr;
private $name_ejr2;
private $state_ejr;
private $machines_maqac;	

public function __GET($k){return $this->$k;}
public function __SET($k,$v){return $this->$k=$v;}
}
class history_clinic_disease{

private $disease_cod_disease;
private $history_cod_disease;

public function __GET($k){return $this->$k;}
public function __SET($k,$v){return $this->$k=$v;}
}
class type_measurement{

	private $cod_measurement;
	private $cod_measurement2;
	private $back;
	private $chest;
	private $abdomen;
	private $leg;
	private $calf_muscle;
	private $arm;
	private $forearm;
	private $weight;

public function __GET($k){return $this->$k;}
public function __SET($k,$v){return $this->$k=$v;}
}
?>
