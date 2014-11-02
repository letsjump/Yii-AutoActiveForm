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
+ It extends CActiveForms native method so you can use every field method like $form->activeInputField, $form->activePasswordField, $form->activeCheckbox (and so on...) just replacing "active" with "auto" in method invocation. Example: $form->activeTextArea(...) become $form->autoTextArea(...)
+ It can be extended so you can use your field generator plugin like Chosen or TinyMce with just some line of code in CustomForm.php configuration
+ You can change form / field configuration globally, locally (just a form) or just for a field.
+ You can alwais use its native method, EG: $form->label(...), $form->activeTextField(...), $form->error(...)
## Usage
- put AutoActiveForm folder in your ext directory
- copy CustomForm.php in your components directory
- call the Yii ActiveForm widget with path of your custom form:
```php
$form=$this->beginWidget('application.components.CustomForm',
	array(
	...
	)
);
```