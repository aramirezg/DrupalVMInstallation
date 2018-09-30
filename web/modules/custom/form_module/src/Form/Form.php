<?php

/**This includes the class library for our form module in Drupal**/
/**Useful links:
Form Creation
https://www.drupal.org/docs/8/api/form-api/introduction-to-form-api

Checkboxes
https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Render%21Element%21Checkboxes.php/class/Checkboxes/8.2.x

Scroll Selector
https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Render%21Element%21Select.php/class/Select/8.2.x
**/
namespace Drupal\form_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element;



class Form extends FormBase{

		/**
		*{@inheritdoc}
		**/

	public function getFormId(){
		return 'form_module';
	}

//This fucntion will build a from using the FormSTateInterface
	public function buildForm(array $form, FormStateInterface $form_state){
		$form['firstName'] = [
			'#type' =>'textfield',
			'#title' => $this->t('First Name'),

		];

		$form['lastName'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Last Name'),

		];


		$form ['checkBox'] = array(
			'#type'=> 'checkbox',
			'#title'=>$this->t('Are you complting this form?'),
			'#return_value'=>1,
			'#default_value'=>0,


		);

		$form['selectBar'] = [
				'#type'=> 'select',
				'#title' => $this->t('Select an Element form the list'),
				'#options'=>[

					'Option1'=> $this->t('Option 1'),
					'Option2'=> $this->t('Option 2'),
					'Option3'=> $this->t('Option 3'),
				],

				'#defalt_value'=>$this->t('default'),

		];
		$form['submit'] = [
			'#type' => 'submit',
			'#value' => $this->t('Submit:'),
		];



		return $form;
	}


 //Function from the base class of FormSTateInterface to validate form_module
	public function validateForm(array &$form, FormStateInterface $form_state){

		if(strlen($form_state->getValue('firstName')) < 1){
			$form_state->setErrorByName('firstName', $this->t('Please enter your first name!'));
		}

		if(strlen($form_state->getValue('lastName')) < 1){
			$form_state->setErrorByName('lastName', $this->t('Please enter your last name!'));
		}

		if ($form_state->getValue('checkBox') != 1){
			$form_state->setErrorByName('checkBox', $this->t('Please check the box!!!'));
		}

		if($form_state->getValue('selectBar' == 'default')){
			$form_state->setErrorByName('selectBar', $this->t('Please choose an option!!'));
		}
	}

	//Function from FormState Interface to submit and complete the form_module
	//This function will also display the values
	public function submitForm(array &$form, FormStateInterface $form_state){
		drupal_set_message($form_state->getValue('firstName'));
		drupal_set_message($form_state->getValue('lastName'));
		drupal_set_message($form_state->getValue('checkBox'));
		drupal_set_message($form_state->getValue('selectBar'));


	}

	/* MULTIPLE CHECKBOXES
			$form['checkList']['checks'] = array(
				'#type' => 'checkboxes',
				'#options'=> array('Check 1'=>$this->t('Check 1'),
													'Check 2'=>$this->t('Check 2'),
													'Check 3'=>$this->t('Check 3')),
				'#title' => $this->t('What checkbox do you want to pick?'),

				//'#value'=> $this->t('Check 1'),
			);*/


	/*public static function validatePattern(array &$form, FormStateInterface $form_state){
		if($form[])

	}*/


}
