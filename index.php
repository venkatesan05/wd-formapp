<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WD Form</title>
<link rel="stylesheet" href="wdf.css" type="text/css" />

</head>
<body> 

<?php require('wd_dom_builder.php'); ?>

<h2 class="page-title"> <center>Sample Signup Form</center> </h2>

<div class="form-container"> 

<?php
           $form = new WD_elements();

$wdForm = $form->openForm('index.php', 'signup_form', 'post', array('class'=>'signupForm') ).

            $form->inputType('text', 'firstname', '', array('id'=>'firstname', 'label' => 'Firstname', 'req' => 'req' ) ).

            $form->inputType('text', 'lastname', '', array('id'=>'lastname', 'label' => 'Lastname' ) ).

            $form->inputType('email', 'email', '', array('id'=>'email', 'label' => 'Email Address' ) ).

            $form->inputType('password', 'password', '', array('id'=>'password', 'label' => 'Password' ) ).

            $form->inputType('number', 'age', '', array('id'=>'age', 'label' => 'Age' ) ).

            $form->inputType('file', 'prf_image', '', array('id'=>'prf_image', 'label' => 'Profile Image' ) ).

            $form->groupTitle('Gender:') .
            $form->inputType('radio', 'gender', 'male', array('id'=>'gender1', 'label' => 'Male', 'req' => 'req' ) ).
            $form->inputType('radio', 'gender', 'female', array('id'=>'gender2', 'label' => 'Female', 'req' => 'req' ) ).

            $form->groupTitle('Interest:') .
            $form->inputType('checkbox', 'interest[]', 'Sports', array('id'=>'interest1', 'label' => 'Sports', 'req' => 'req' ) ).
            $form->inputType('checkbox', 'interest[]', 'Learning', array('id'=>'interest2', 'label' => 'Learning' , 'req' => 'req' ) ).

            $form->setTextArea('comments', '', array('id'=>'comments', 'placeholder'=>'Enter your comments..', 'req' => 'req') ) .              
   
            $form->selectBox('country', array(
                                                   ''=>'Select country',
                                                'ind'=>'India',
                                                'fra'=>'France',
                                                'lka'=>'Sri Lanka',
                                                'fra'=>'France',
                                                'usa'=>'United States' 
                                            ),
                                        array('id'=>'country', 'class'=>'country locations', 'req' => 'req')
                            ).

            $form->inputType('submit', 'signup', 'Sign Up') .

            $form->closeForm();
    
    echo $wdForm;
?>
</div>

</body>
</html>
