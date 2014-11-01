# AutoActiveForm

In a web full of complex html form templates, this extension provides a faster way to draw html form fields in Yii 1.1.
It also has an Access control system to give read / write access to fields according Yii RBAC access rules.

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
    		<input name="Model[oggetto]" id="Model_name" type="text" maxlength="255" value="" />
    		<span class="errorMessage" id="Model_name_em_" style="display:none"></span>
    </span>
</div>
```
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
