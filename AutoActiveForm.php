<?php

/**
 * AutoActiveForm class file
 * A faster way to setup form fields in Yii Framework 1.1
 *
 * @author  Gianpaolo Scrigna <letsjump@gmail.com>
 * @link    http://github.com/letsjump/Yii.AutoActiveForm
 * @copyright Copyright &copy; 2008-2011 Yii Software LLC, 2013 Gianpaolo Scrigna
 * @license http://www.yiiframework.com/license/
 *
 * In a web full of complex html form templates, this extension provides
 * a faster way to draw html form fields in Yii 1.1.
 * It also has an Access control system to give
 * read / write access to every form component
 * according Yii RBAC access rules.
 */

class AutoActiveForm extends CActiveForm
{
	/**
	 * @var string $viewPath Path alias
	 * to autoActiveForm view folder
	 */
	public $viewPath = 'ext.autoActiveForm.views';

	/**
	 * @var string $viewFile the name of the default view
	 */
	public $viewFile = 'default';

	/**
	 * @var bool $accessControl Enable or disable access control for each field
	 */
	public $accessControl = false;

	/**
	 * @var string $allowAction The action to perform when access control is disabled
	 *                          Usually the action that draw field with label and error
	 */
	public $allowAction = 'write';

	/**
	 * @var bool $showLabels Main label generator switch
	 *                       Usually set to false when use placeholder
	 */
	public $showLabels = true;

	/**
	 * @var bool $labelToPlaceholder create a placeholder property
	 *                               and put label text into it
	 */
	public $labelToPlaceholder = false;

	/**
	 * @var array $extractFromHtmlOptions
	 */
	public $extractFromHtmlOptions = Array(
		'errorHtmlOptions',
		'labelHtmlOptions',
		'jsOptions',
		'roValue',
		'viewFile',
		//'itemTemplate'
	);

	/**
	 * @var object $params used to build field property
	 */
	protected $params;

	/**
	 * @var object $_fieldPermission Object of permission read from
	 *                               method getAccessRules()
	 */
	protected $_fieldsPermissions;

	/**
	 * @var string $roTemplate Template for field in readonly mode
	 */
	public $roTemplate = "<span class='read'>{value}&nbsp;</span>";

	/**
	 * Initializes the widget.
	 * This renders the form open tag.
	 */
	public function init()
	{
		parent::init();
	}

	/**
	 * Runs the widget.
	 * This registers the necessary javascript code and renders the form close tag.
	 */
	public function run()
	{
		parent::run();
	}

	/**
	 * Renders a url field for a model attribute.
	 * This method is a wrapper of {@link CHtml::activeUrlField}.
	 * Please check {@link CHtml::activeUrlField} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated input field
	 * @since 1.1.11
	 */
	public function autoUrlField($model,$attribute,$htmlOptions=array())
	{
		$method = Array('CHtml', 'activeUrlField');
		return $this->buildField($method, $model, $attribute, NULL, $htmlOptions);
	}

	/**
	 * Renders an email field for a model attribute.
	 * This method is a wrapper of {@link CHtml::activeEmailField}.
	 * Please check {@link CHtml::activeEmailField} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated input field
	 * @since 1.1.11
	 */
	public function autoEmailField($model,$attribute,$htmlOptions=array())
	{
		$method = Array('CHtml', 'activeEmailField');
		return $this->buildField($method, $model, $attribute, NULL, $htmlOptions);
	}

	/**
	 * Renders a number field for a model attribute.
	 * This method is a wrapper of {@link CHtml::activeNumberField}.
	 * Please check {@link CHtml::activeNumberField} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated input field
	 * @since 1.1.11
	 */
	public function autoNumberField($model,$attribute,$htmlOptions=array())
	{
		return CHtml::activeNumberField($model,$attribute,$htmlOptions);
	}

	/**
	 * Generates a range field for a model attribute.
	 * This method is a wrapper of {@link CHtml::activeRangeField}.
	 * Please check {@link CHtml::activeRangeField} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated input field
	 * @since 1.1.11
	 */
	public function autoRangeField($model,$attribute,$htmlOptions=array())
	{
		$method = Array('CHtml', 'activeRangeField');
		return $this->buildField($method, $model, $attribute, NULL, $htmlOptions);
	}

	/**
	 * Renders a date field for a model attribute.
	 * This method is a wrapper of {@link CHtml::activeDateField}.
	 * Please check {@link CHtml::activeDateField} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated input field
	 * @since 1.1.11
	 */
	public function autoDateField($model,$attribute,$htmlOptions=array())
	{
		$method = Array('CHtml', 'activeDateField');
		return $this->buildField($method, $model, $attribute, NULL, $htmlOptions);
	}

	/**
	 * Renders a time field for a model attribute.
	 * This method is a wrapper of {@link CHtml::activeTimeField}.
	 * Please check {@link CHtml::activeTimeField} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated input field
	 * @since 1.1.14
	 */
	public function autoTimeField($model,$attribute,$htmlOptions=array())
	{
		$method = Array('CHtml', 'activeTimeField');
		return $this->buildField($method, $model, $attribute, NULL, $htmlOptions);
	}

	/**
	 * Renders a time field for a model attribute.
	 * This method is a wrapper of {@link CHtml::activeTimeField}.
	 * Please check {@link CHtml::activeTimeField} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated input field
	 * @since 1.1.14
	 */
	public function autoTelField($model,$attribute,$htmlOptions=array())
	{
		$method = Array('CHtml', 'activeTelField');
		return $this->buildField($method, $model, $attribute, NULL, $htmlOptions);
	}

	/**
	 * Renders a text field for a model attribute.
	 * This method is a wrapper of {@link CHtml::activeTextField}.
	 * Please check {@link CHtml::activeTextField} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated input field
	 */
	public function textField($model,$attribute,$htmlOptions=array())
	{
		return CHtml::activeTextField($model,$attribute,$htmlOptions);
	}

	/**
	 * Renders a text field for a model attribute.
	 * This method is a wrapper of {@link CHtml::activeTextField}.
	 * Please check {@link CHtml::activeTextField} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated input field
	 */
	public function autoTextField($model,$attribute,$htmlOptions=array())
	{
		$method = Array('CHtml', 'activeTextField');
		return $this->buildField($method, $model, $attribute, NULL, $htmlOptions);
	}

	/**
	 * Renders a password field for a model attribute.
	 * This method is a wrapper of {@link CHtml::activePasswordField}.
	 * Please check {@link CHtml::activePasswordField} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated input field
	 */
	public function autoPasswordField($model,$attribute,$htmlOptions=array())
	{
		$method = Array('CHtml', 'activePasswordField');
		return $this->buildField($method, $model, $attribute, NULL, $htmlOptions);
	}

	/**
	 * Renders a text area for a model attribute.
	 * This method is a wrapper of {@link CHtml::activeTextArea}.
	 * Please check {@link CHtml::activeTextArea} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated text area
	 */
	public function autoTextArea($model,$attribute,$htmlOptions=array())
	{
		$method = Array('CHtml', 'activeTextArea');
		return $this->buildField($method, $model, $attribute, NULL, $htmlOptions);
	}

	/**
	 * Renders a file field for a model attribute.
	 * This method is a wrapper of {@link CHtml::activeFileField}.
	 * Please check {@link CHtml::activeFileField} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes
	 * @return string the generated input field
	 */
	public function autoFileField($model,$attribute,$htmlOptions=array())
	{
		$method = Array('CHtml', 'activeFileField');
		return $this->buildField($method, $model, $attribute, NULL, $htmlOptions);
	}

	/**
	 * Renders a radio button for a model attribute.
	 * This method is a wrapper of {@link CHtml::activeRadioButton}.
	 * Please check {@link CHtml::activeRadioButton} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated radio button
	 */
	public function autoRadioButton($model,$attribute,$htmlOptions=array())
	{
		$method = Array('CHtml', 'activeRadioButton');
		return $this->buildField($method, $model, $attribute, NULL, $htmlOptions);
	}

	/**
	 * Renders a checkbox for a model attribute.
	 * This method is a wrapper of {@link CHtml::activeCheckBox}.
	 * Please check {@link CHtml::activeCheckBox} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated check box
	 */
	public function autoCheckBox($model,$attribute,$htmlOptions=array())
	{
		$method = Array('CHtml', 'activeCheckBox');
		return $this->buildField($method, $model, $attribute, NULL, $htmlOptions);
	}


	/**
	 * Renders a dropdown list for a model attribute.
	 * This method is a wrapper of {@link CHtml::activeDropDownList}.
	 * Please check {@link CHtml::activeDropDownList} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $data data for generating the list options (value=>display)
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated drop down list
	 */
	public function autoDropDownList($model,$attribute,$data,$htmlOptions=array())
	{
		$method = Array('CHtml', 'activeDropDownList');
		return $this->buildField($method, $model, $attribute, $data, $htmlOptions);
		//return CHtml::activeDropDownList($model,$attribute,$data,$htmlOptions);
	}

	/**
	 * Renders a list box for a model attribute.
	 * This method is a wrapper of {@link CHtml::activeListBox}.
	 * Please check {@link CHtml::activeListBox} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $data data for generating the list options (value=>display)
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated list box
	 */
	public function autoListBox($model,$attribute,$data,$htmlOptions=array())
	{
		return CHtml::activeListBox($model,$attribute,$data,$htmlOptions);
	}

	/**
	 * Renders a checkbox list for a model attribute.
	 * This method is a wrapper of {@link CHtml::activeCheckBoxList}.
	 * Please check {@link CHtml::activeCheckBoxList} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $data value-label pairs used to generate the check box list.
	 * @param array $htmlOptions addtional HTML options.
	 * @return string the generated check box list
	 */
	public function autoCheckBoxList($model,$attribute,$data,$htmlOptions=array())
	{
		return CHtml::activeCheckBoxList($model,$attribute,$data,$htmlOptions);
	}

	/**
	 * Renders a radio button list for a model attribute.
	 * This method is a wrapper of {@link CHtml::activeRadioButtonList}.
	 * Please check {@link CHtml::activeRadioButtonList} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $data value-label pairs used to generate the radio button list.
	 * @param array $htmlOptions addtional HTML options.
	 * @return string the generated radio button list
	 */
	public function autoRadioButtonList($model,$attribute,$data,$htmlOptions=array())
	{
		$method = Array('CHtml', 'activeRadioButtonList');
		return $this->buildField($method, $model, $attribute, $data, $htmlOptions);
		//return CHtml::activeRadioButtonList($model,$attribute,$data,$htmlOptions);
	}


	/**
	 * Build a standard CHtml field with label and error,
	 * if pass required access control
	 * @param array $method Class::Method needed to build the field
	 * @param CActiveRecord $model Form's related model
	 * @param string $attribute Form's model related attribute
	 * @param array $data of select, multiselect ecc... fields
	 * @param array $htmlOptions html attributes that render with the field
	 *
	 * @return string CHtml field formatted with label & error
	 */
	protected function buildField($method, $model, $attribute, $data, $htmlOptions)
	{
		$this->params = new stdClass();
		$this->params->method = $method;
		$this->params->model = $model;
		$this->params->attribute = $attribute;
		$this->params->data = $data;
		$this->extractOptions($htmlOptions);

		$this->params->args[] = $model;
		$this->params->args[] = $attribute;
		if (!empty($data))
		{
			$this->params->args[] = $data;
		}
		$this->params->args[] = $this->params->htmlOptions;

		// Access control
		if ($this->accessControl === false
			|| Yii::app()->user->checkAccess('admin')
		)
		{
			return call_user_func ('self::'.$this->allowAction);
		}
		else
		{
			$design = $this->getFieldsPermissions($model);
			if(isset($design->$attribute) && method_exists($this, $design->$attribute))
			{
				return call_user_func ('self::'.$design->$attribute);
			}
		}
	}

	/**
	 * Extract parameters specified with property $extractFromHtmlOptions
	 * passed by CActiveForm property  $htmlOptions array
	 * @param $htmlOptions
	 */
	protected function extractOptions($htmlOptions)
	{
		foreach($this->extractFromHtmlOptions as $option)
		{
			if(array_key_exists($option, $htmlOptions))
			{
				if(isset($this->$option) && is_array($this->$option))
				{
					$this->params->$option = CMap::mergeArray($this->$option, $htmlOptions[$option]);
				}
				else
				{
					$this->params->$option = $htmlOptions[$option];
				}
				unset($htmlOptions[$option]);
			}
			else if(isset($this->$option))
			{
				$this->params->$option = $this->$option;
			}
			else
			{
				$this->params->$option = null;
			}
		}
		$this->params->htmlOptions = $htmlOptions;
	}

	/**
	 * Create a CHtml label and / or add a placeholder property to its field
	 * If property $labelToPlaceholder is TRUE, add placeholder property
	 * to its related field
	 * If property $showLabels is FALSE it returns an empty string
	 *
	 * @return string CHtml::labelEx Label if $showLabels is TRUE
	 *                else returns an empty string
	 */
	protected function createLabel() {
		$attribute = $this->params->attribute;
		$model     = $this->params->model;
		if ($this->labelToPlaceholder === true
			&& !isset($this->params->htmlOptions['placeholder']))
		{
			$attributeLabels = $model->attributeLabels();
			if(isset($attributeLabels[$attribute]))
			{
				$this->params->htmlOptions['placeholder'] = $attributeLabels[$attribute];
			}
		}
		if ($this->showLabels !== false && !isset($this->params->labelHtmlOptions['hide']))
		{
			return $this->labelEx($model, $attribute, $this->params->labelHtmlOptions);
		}
		else
		{
			return "";
		}
	}

	/**
	 * Render the field with write permissions
	 * based on $viewFile template
	 *
	 * @return string CHTML field formatted with label and error
	 */
	protected function write()
	{
		$viewFile = (!empty($this->params->viewFile)) ? $this->params->viewFile : $this->viewFile;
		$data = new stdClass();
		$data->label = $this->createLabel();
		if($this->params->data != null)
		{
			$data->field = call_user_func(
				$this->params->method,
				$this->params->model,
				$this->params->attribute,
				$this->params->data,
				$this->params->htmlOptions
			);
		}
		else
		{
			$data->field = call_user_func(
				$this->params->method,
				$this->params->model,
				$this->params->attribute,
				$this->params->htmlOptions
			);
		}
		$data->error = $this->error(
			$this->params->model,
			$this->params->attribute,
			$this->params->errorHtmlOptions
		);

		return $this->render($this->viewPath . '.' . $viewFile, $data, TRUE);
	}

	/**
	 * Render the field value with read permissions
	 * based on $roTemplate template
	 *
	 * @return string CHTML string formatted with label
	 */
	protected function read()
	{
		$data = new stdClass();
		$attribute = $this->params->attribute;
		$model = $this->params->model;
		$roValue = '';
		$data->label = $this->createLabel();
		if (!empty($this->params->roValue))
		{
			$roValue = $this->params->roValue;
		} elseif (!empty($model->$attribute))
		{
			$roValue = $model->$attribute;
		}
		$data->field = str_replace('{value}', $roValue, $this->roTemplate);
		$data->error = "";
		return $this->render($this->viewPath . '.' . $this->viewFile, $data, TRUE);
	}

	/**
	 * Build an object with each field's permissions
	 * based on user's Yii RBAC Access Rules
	 * depending on a scenario if specified...
	 * @param CActiveRecord $model of the form
	 *
	 * @return object of field's permission
	 */
	protected function getFieldsPermissions($model)
	{
		if(empty($this->_fieldsPermissions) && !empty($model->accessRules))
		{
			$scenario = $model->getScenario();
			$permissions = new stdClass();
			foreach($model->accessRules as $rule=>$opeArray)
			{
				if(
					($rule != Yii::app()->user->guestName && Yii::app()->user->checkAccess($rule))
					|| ($rule == Yii::app()->user->guestName && Yii::app()->user->isGuest)
				)
				{
					foreach($opeArray as $ope)
					{
						$fields = explode(',', preg_replace('/\s/', '', $ope[0]));
						if(!isset($ope['on']))
						{
							foreach($fields as $field)
							{
								$permissions->$field = $ope[1];
							}
						}
						else if(isset($ope['on']) && $ope['on'] == $scenario)
						{
							foreach($fields as $field)
							{
								$permissions->$field = $ope[1];
							}
						}
					}
				}
			}
			$this->_fieldsPermissions = $permissions;
		}
		return $this->_fieldsPermissions;
	}
}