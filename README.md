# AutoActiveForm

In a web full of *complex html form templates*, this extension provides a **faster way to draw fields** in Yii Framework 1.1.
It also has an **access control system** in order to give *read / hide / write*  access to every field according to *Yii RBAC Access Rules*.

## Simple example
this code
```php
echo $form->autoTextField($model, 'Name');
```
generates this html
```html
<div class="fieldcontainer">
    <label for="Model_name" class="required">
        Oggetto 
        <span class="required">*</span>
    </label>
    <span class="field">
    		<input name="Model[name]" id="Model_name" type="text" maxlength="255" value="" />
    		<span class="errorMessage" id="Model_name_em_" style="display:none"></span>
    </span>
</div>
```
and this code
```php
echo $form->autoDatePicker($model,'cr_date');
```
generates
```html
<div class="fieldcontainer">
	<label for="Model_cr_date">Data Creazione</label>
	<span class="field">
		<input id="Model_cr_date" name="Model[cr_date]" type="text" value="05/07/2014" />
		<span class="errorMessage" id="Model_cr_date_em_" style="display:none"></span>
	</span>
</div>
<script type="text/javascript">
/*<![CDATA[*/
jQuery('#Model_cr_date').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['it'],null));
/*]]>*/
</script>
```
## Benefits
+ 	It extends `CActiveForms` native method so you can invoke every field (like `$form->activeInputField`, 	`$form->activePasswordField`, `$form->activeCheckbox` and so on...) just replacing `active` with `auto` in the original name. Example: `$form->activeTextArea(...)` becomes `$form->autoTextArea(...)`
+ 	**It can be extended** so you can use your *field generator plugin* like **Chosen** or **TinyMce** with just some line of 	code in your *CustomForm.php* configuration file
+ 	You can change configuration **globally** or locally: just **one form** or just **one field**.
+	Field templates are mastered as normal **Yii view files**
+ 	You can also use `CActiveForm` native method, EG: `$form->label(...)`, `$form->activeTextField(...)` and `$form->error(...)`
+ 	A complete **access control** to draw field according with **user permissions**

## Usage
- 	put AutoActiveForm folder in your *ext* directory
- 	copy *CustomForm.php* in your components directory and configure it
- 	modify `Yii::import('ext.autoActiveForm.AutoActiveForm')` according to fit the extension's alias path
- 	call Yii ActiveForm widget with the path of your custom form:
```php
$form=$this->beginWidget('application.components.CustomForm',
	array(
	...
	)
);
```
- 	call every *CActiveForm field* object replacing his `active` prefix with `auto`
```php
$form->autoTextField($model, 'surname');
$form->autoPassword($model, 'pass');
$form->autoCheckBox($model, 'yes_no');
$form->autoDropDownList($model, ',my_list', Array(1=>'One little indian', 2=>'Two little indians'));
```

## Advanced fields configuration
### Add field HTML options
As in CActiveForm you'll pass configurations using `$htmlOptions` array:
```php
$form->autoTextField($model, 'surname', Array('class'=>'oh_my_god', 'style'=>'color: green'));
```
### Add label or error HTML options
If you need to pass configurations to the *label* or *error* HTML tag, *AutoActiveForm* provides two special array of parameters inside `$htmlOptions`:
- `labelHtmlOptions` (array)
- `errorHtmlOptions` (array)

Example:
```php
$form->autoTextField($model, 'gender', Array('labelHtmlOptions'=>Array('class'=>'required'));
$form->autoTextField($model, 'age', Array('errorHtmlOptions'=>Array('class'=>'blink'));
```
### Additional field configuration settings
In addition to `labelHtmlOptions` and `errorHtmlOptions`, you can pass some other array of parameters to `$htmlOptions`:
- `jsOptions`: 	(array) special options used in complex jQuery fields like TinyMce
- `roValue`: 	(string) read only value for this field
- `viewFile`: 	(string) alternative view just for this field

### Form configurations
*AutoActiveForm* has some special configuration that changes the default behavior:
- `$viewPath`: 			(string) path alias to the view's folder
- `$viewFile`: 			(string) name of the default view
- `$accessControl`: 		(bool) enable / disable access control
- `$addHtmlOptions`:		(array) add an array of $htmlOptions to every field of the form
- `$allowAction`:			(string) action to perform when access control is disabled. Usually the action `write` that draw a form field with its label and its error tag
- `$showLabels`:			(bool) enable / disable the label generator. Usually set to false when use placeholder
- `$labelToPlaceholder`:	(bool) automatically generates a `placeholder=""` attribute with the label's text for every field

#### Set form configurations globally
To set configurations globally, you'll have to act in the `init()` method of your `customForm` class:
```php
class CustomForm extends AutoActiveForm
{
	public function init() {
    		// set here your global configurations
			$this->formParameterName = your global value
			parent::init();
    	}
    	...
    }
    ...
}
```

#### Set form configurations locally (this form)
To set a form parameter just for a form, there is an `$autoActiveForm` array to set in its form `$this->beginWidget()` configuration:
```php
$form=$this->beginWidget('application.components.customForm',
		array(
		'id'=>'my-automatic-form',
		'autoActiveForm'=>Array(
			// add here some configurations just for this form
			'accessControl' => true,
			...
		),
		'enableAjaxValidation'=>true,
		'htmlOptions' => array(
			'class'=>'stdform'),
		)
	);
```
If you also need to add some $htmlOptions to every field of this form, there is a special `addHtmlOptions` parameter:
```php
$form=$this->beginWidget('application.components.customForm',
		array(
		'id'=>'my-coloured-form',
		'autoActiveForm'=>Array(
			// add here some configurations just for this form
			'addHtmlOptions'=>Array('class'=>'green_border')
		),
		'enableAjaxValidation'=>true,
		'htmlOptions' => array(
			'class'=>'stdform'),
		)
	);
```
In the above example, every field of the generated form will have the html property `class="green-border"` automagically setted.
## Access Control
Works, but I'm writing some documentation