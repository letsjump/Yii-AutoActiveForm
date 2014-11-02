# AutoActiveForm

In a web full of complex html form templates, this extension provides a faster way to draw fields in Yii Framework 1.1.
It also has an Access control system to give read / write access to every field according Yii RBAC access rules.

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
		<input id="Richiesta_cr_date" name="Richiesta[cr_date]" type="text" value="05/07/2014" />
		<span class="errorMessage" id="Richiesta_cr_date_em_" style="display:none"></span>
	</span>
</div>
<script type="text/javascript">
/*<![CDATA[*/
jQuery('#Model_cr_date').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['it'],null));
/*]]>*/
</script>
```
## Benefits
+ 	It extends CActiveForms native method so you can use every field method like $form->activeInputField, 	$form->activePasswordField, $form->activeCheckbox (and so on...) just replacing "active" with "auto" in method 	invocation. Example: $form->activeTextArea(...) become $form->autoTextArea(...)
+ 	It can be extended so you can use your field generator plugin like Chosen or TinyMce with just some line of 	code in CustomForm.php configuration
+ 	You can change configuration globally or locally: just one form or just one field.
+	Field template is mastered as a normal Yii view
+ 	You can alwais use its native method, EG: $form->label(...), $form->activeTextField(...), $form->error(...)
+ 	A complete access control to draw field according with user permissions

## Usage
- 	put AutoActiveForm folder in your ext directory
- 	copy CustomForm.php in your components directory
- 	modify Yii::import('ext.autoActiveForm.AutoActiveForm') according to fit the extension's path alias
- 	call Yii ActiveForm widget with path of your custom form:
```php
$form=$this->beginWidget('application.components.CustomForm',
	array(
	...
	)
);
```
- 	call every CActiveForm field object replacing his "active" prefix with "auto"
```php
$form->autoTextField($model, 'surname');
$form->autoPassword($model, 'pass');
$form->autoCheckBox($model, 'yes_no');
$form->autoDropDownList($model, ',my_list', Array(1=>'One little indian', 2=>'Two little indians'));
```

## Advanced fields configuration
### Add field HTML options
As in CActiveForm you'll pass configurations using $htmlOptions Array:
```php
$form->autoTextField($model, 'surname', Array('class'=>'oh_my_god', 'style'=>'color: green'));
```
### Add label or error HTML options
If you have to pass configurations to the label or error, AutoActiveForm provides two special $htmlOptions arrays:
- labelHtmlOptions (array)
- errorHtmlOptions (array)
Example:
```php
$form->autoTextField($model, 'gender', Array('labelHtmlOptions'=>Array('class'=>'required'));
$form->autoTextField($model, 'age', Array('errorHtmlOptions'=>Array('class'=>'blink'));
```
### Additional configuration settings
In addition to "labelHtmlOptions" and "errorHtmlOptions", you can pass some other arrays of parameters to $htmlOptions array:
- jsOptions: 	special options used in complex jQuery fields like TinyMce
- roValue: 		read only value for this field
- viewFile: 	alternative view just for this field

### Set configurations globally
...

### Set configurations locally (this form)
...