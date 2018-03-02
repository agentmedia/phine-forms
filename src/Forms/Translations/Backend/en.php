<?php
use Phine\Framework\Localization\PhpTranslator;
$translator = PhpTranslator::Singleton();
$lang = 'en';

//Form Form
$translator->AddTranslation($lang, 'Forms.Form.BackendName', 'Form');
$translator->AddTranslation($lang, 'Forms.FormForm.Title', 'Edit Form');
$translator->AddTranslation($lang, 'Forms.FormForm.Legend', 'Form Settings');
$translator->AddTranslation($lang, 'Forms.FormForm.Description', 'Define the form properties, here. Form fields can be added in the content element tree view.');
$translator->AddTranslation($lang, 'Forms.FormForm.Method', 'Request Method');
$translator->AddTranslation($lang, 'Forms.FormForm.Method.Post', 'POST');
$translator->AddTranslation($lang, 'Forms.FormForm.Method.Get', 'GET');
$translator->AddTranslation($lang, 'Forms.FormForm.RedirectUrl', 'Redirect URL');
$translator->AddTranslation($lang, 'Forms.FormForm.SaveTo', 'Save To Table');
$translator->AddTranslation($lang, 'Forms.FormForm.SaveTo.None', '- No Table -');
$translator->AddTranslation($lang, 'Forms.FormForm.SendFrom', 'Send Mail From');
$translator->AddTranslation($lang, 'Forms.FormForm.SendTo', 'Send Mail To');
$translator->AddTranslation($lang, 'Forms.FormForm.Submit', 'Save');

$translator->AddTranslation($lang, 'Forms.FormForm.SendFrom.Validation.Required.Missing', 'You must specify either a table or both FROM and TO e-mail addresses');
$translator->AddTranslation($lang, 'Forms.FormForm.SendTo.Validation.Required.Missing', 'You must specify either a table or both FROM and TO e-mail addresses');
$translator->AddTranslation($lang, 'Forms.FormForm.SaveTo.Validation.Required.Missing', 'You must specify either a table or both FROM and TO e-mail addresses');

//radio form
$translator->AddTranslation($lang, 'Forms.Radio.BackendName', 'Radio');
$translator->AddTranslation($lang, 'Forms.RadioForm.Title', 'Edit Radio Field');
$translator->AddTranslation($lang, 'Forms.RadioForm.Legend', 'Field Settings');
$translator->AddTranslation($lang, 'Forms.RadioForm.Description', 'Here you can edit the radio button group.');
$translator->AddTranslation($lang, 'Forms.RadioForm.Name', 'Name');
$translator->AddTranslation($lang, 'Forms.RadioForm.Label', 'Label');
$translator->AddTranslation($lang, 'Forms.RadioForm.Value', 'Default Value');
$translator->AddTranslation($lang, 'Forms.RadioForm.Required', 'Obligatory field (One option has to be selected)');
$translator->AddTranslation($lang, 'Forms.RadioForm.Options', 'Options');
$translator->AddTranslation($lang, 'Forms.RadioForm.Options.Placeholder', 'One Option per line in the format Value:Text');
$translator->AddTranslation($lang, 'Forms.RadioForm.Submit', 'Save');

$translator->AddTranslation($lang, 'Forms.RadioForm.Name.Validation.Required.Missing', 'Field name is required');

//select form
$translator->AddTranslation($lang, 'Forms.Select.BackendName', 'Select Field');
$translator->AddTranslation($lang, 'Forms.SelectForm.Title', 'Edit Select Field');
$translator->AddTranslation($lang, 'Forms.SelectForm.Legend', 'Field Settings');
$translator->AddTranslation($lang, 'Forms.SelectForm.Description', 'Here you can edit the selection field and its options.');
$translator->AddTranslation($lang, 'Forms.SelectForm.Name', 'Name');
$translator->AddTranslation($lang, 'Forms.SelectForm.Label', 'Label');
$translator->AddTranslation($lang, 'Forms.SelectForm.Value', 'Default Value');
$translator->AddTranslation($lang, 'Forms.SelectForm.Required', 'Obligatory field (Option with non-empty value has to be selected)');
$translator->AddTranslation($lang, 'Forms.SelectForm.Options', 'Options');
$translator->AddTranslation($lang, 'Forms.SelectForm.Options.Placeholder', 'One Option per line in the format Value:Text');
$translator->AddTranslation($lang, 'Forms.SelectForm.Submit', 'Save');

$translator->AddTranslation($lang, 'Forms.SelectForm.Name.Validation.Required.Missing', 'Field name is required');


//textarea form
$translator->AddTranslation($lang, 'Forms.Textarea.BackendName', 'Textarea');
$translator->AddTranslation($lang, 'Forms.TextareaForm.Title', 'Edit textarea');
$translator->AddTranslation($lang, 'Forms.TextareaForm.Description', 'Here is the place to adjust the settings of the mult-line textarea.');
$translator->AddTranslation($lang, 'Forms.TextareaForm.Legend', 'Textarea Settings');
$translator->AddTranslation($lang, 'Forms.TextareaForm.Name', 'Name');
$translator->AddTranslation($lang, 'Forms.TextareaForm.Value', 'Default Value');
$translator->AddTranslation($lang, 'Forms.TextareaForm.Label', 'Label');

$translator->AddTranslation($lang, 'Forms.TextareaForm.Pattern', 'Prüfmuster');
$translator->AddTranslation($lang, 'Forms.TextareaForm.Pattern.Placeholder', 'Regulärer Ausdruck');
$translator->AddTranslation($lang, 'Forms.TextareaForm.MaxLength', 'Maximale Textlänge');
$translator->AddTranslation($lang, 'Forms.TextareaForm.MinLength', 'Minimale Textlänge');

$translator->AddTranslation($lang, 'Forms.TextareaForm.Required', 'Is Obligatory (Text must be filled)');
$translator->AddTranslation($lang, 'Forms.TextareaForm.Submit', 'Save');
$translator->AddTranslation($lang, 'Forms.TextareaForm.Name.Validation.Required.Missing', 'Field name is required');
$translator->AddTranslation($lang, 'Forms.TextareaForm.MinLength.Validation.Integer.HasNonDigits', 'Please insert an integer number');
$translator->AddTranslation($lang, 'Forms.TextareaForm.MaxLength.Validation.Integer.HasNonDigits', 'Please insert an integer number');

//textfield form
$translator->AddTranslation($lang, 'Forms.TextfieldType.Text', 'Arbitrary Text');
$translator->AddTranslation($lang, 'Forms.TextfieldType.Tel', 'Telephone Number');
$translator->AddTranslation($lang, 'Forms.TextfieldType.Email', 'E-Mail');
$translator->AddTranslation($lang, 'Forms.TextfieldType.Url', 'URL');

$translator->AddTranslation($lang, 'Forms.Textfield.BackendName', 'Text Field');
$translator->AddTranslation($lang, 'Forms.TextfieldForm.Title', 'Edit Text Field');
$translator->AddTranslation($lang, 'Forms.TextfieldForm.Description', 'Adjust the properties of the single lined text field in this form.');
$translator->AddTranslation($lang, 'Forms.TextfieldForm.Legend', 'Text Field Settings');
$translator->AddTranslation($lang, 'Forms.TextfieldForm.Name', 'Name');
$translator->AddTranslation($lang, 'Forms.TextfieldForm.Value', 'Default Value');
$translator->AddTranslation($lang, 'Forms.TextfieldForm.Label', 'Label');
$translator->AddTranslation($lang, 'Forms.TextfieldForm.Required', 'Is Obligatory (Text must not be empty)');
$translator->AddTranslation($lang, 'Forms.TextfieldForm.Type', 'Type');
$translator->AddTranslation($lang, 'Forms.TextfieldForm.Pattern', 'Check Pattern');
$translator->AddTranslation($lang, 'Forms.TextfieldForm.Pattern.Placeholder', 'Regular Expression');
$translator->AddTranslation($lang, 'Forms.TextfieldForm.MaxLength', 'Maximum Length');
$translator->AddTranslation($lang, 'Forms.TextfieldForm.Submit', 'Save');

$translator->AddTranslation($lang, 'Forms.TextfieldForm.Name.Validation.Required.Missing', 'Field name is required');
$translator->AddTranslation($lang, 'Forms.TextfieldForm.Type.Validation.Required.Missing', 'Please select the field type');
$translator->AddTranslation($lang, 'Forms.TextfieldForm.MinLength.Validation.Integer.HasNonDigits', 'Please insert an integer number');
$translator->AddTranslation($lang, 'Forms.TextfieldForm.MaxLength.Validation.Integer.HasNonDigits', 'Pleaese insert an integer number');

//checkbox form
$translator->AddTranslation($lang, 'Forms.Checkbox.BackendName', 'Checkbox');
$translator->AddTranslation($lang, 'Forms.CheckboxForm.Title', 'Edit Checkbox');
$translator->AddTranslation($lang, 'Forms.CheckboxForm.Description', 'Change or set the properties of the checkbox field in the form below.');
$translator->AddTranslation($lang, 'Forms.CheckboxForm.Legend', 'Checkbox Settings');
$translator->AddTranslation($lang, 'Forms.CheckboxForm.Name', 'Name');
$translator->AddTranslation($lang, 'Forms.CheckboxForm.CheckedValue', 'Submitted Value');
$translator->AddTranslation($lang, 'Forms.CheckboxForm.Label', 'Label');
$translator->AddTranslation($lang, 'Forms.CheckboxForm.Required', 'Is Obligatory (Box must be checked)');
$translator->AddTranslation($lang, 'Forms.CheckboxForm.Checked', 'Checked by Default');
$translator->AddTranslation($lang, 'Forms.CheckboxForm.Submit', 'Save');

$translator->AddTranslation($lang, 'Forms.CheckboxForm.Name.Validation.Required.Missing', 'Field name is required');
$translator->AddTranslation($lang, 'Forms.CheckboxForm.CheckedValue.Validation.Required.Missing', 'Define the submitted value');

//submit form
$translator->AddTranslation($lang, 'Forms.Submit.BackendName', 'Submit Button');
$translator->AddTranslation($lang, 'Forms.SubmitForm.Title', 'Edit Submut Button');
$translator->AddTranslation($lang, 'Forms.SubmitForm.Description', 'Here you can change the attributes of the form submit button.');
$translator->AddTranslation($lang, 'Forms.SubmitForm.Legend', 'Button Settings');
$translator->AddTranslation($lang, 'Forms.SubmitForm.Name', 'Name');
$translator->AddTranslation($lang, 'Forms.SubmitForm.Value', 'Text');
$translator->AddTranslation($lang, 'Forms.SubmitForm.Submit', 'Save');

$translator->AddTranslation($lang, 'Forms.SubmitForm.Name.Validation.Required.Missing', 'Button name is required');

//fieldset form
$translator->AddTranslation($lang, 'Forms.Fieldset.BackendName', 'Fieldset');
$translator->AddTranslation($lang, 'Forms.FieldsetForm.Title', 'Edit Field Set');
$translator->AddTranslation($lang, 'Forms.FieldsetForm.Description', 'You can adjust the properties of the fieldset to match your needs.');
$translator->AddTranslation($lang, 'Forms.FieldsetForm.FormLegend', 'Fieldset Settings');
$translator->AddTranslation($lang, 'Forms.FieldsetForm.Legend', 'Legend');
$translator->AddTranslation($lang, 'Forms.FieldsetForm.Submit', 'Save');

/*numberfield form */
$translator->AddTranslation($lang, 'Forms.Numberfield.BackendName', 'Number Field');
$translator->AddTranslation($lang, 'Forms.NumberfieldForm.Title', 'Edit Number Field');
$translator->AddTranslation($lang, 'Forms.NumberfieldForm.Description', 'Number fields can be filled with posiive and negative integer or floating point values. Among other settings, the value range can be adjusted here.');
$translator->AddTranslation($lang, 'Forms.NumberfieldForm.Legend', 'Number Field Settings');
$translator->AddTranslation($lang, 'Forms.NumberfieldForm.Label', 'Label');
$translator->AddTranslation($lang, 'Forms.NumberfieldForm.Name', 'Name');
$translator->AddTranslation($lang, 'Forms.NumberfieldForm.Value', 'Value');
$translator->AddTranslation($lang, 'Forms.NumberfieldForm.Min', 'Minimum');
$translator->AddTranslation($lang, 'Forms.NumberfieldForm.Max', 'Maximum');
$translator->AddTranslation($lang, 'Forms.NumberfieldForm.Step', 'Step Size');
$translator->AddTranslation($lang, 'Forms.NumberfieldForm.Required', 'Is Obligatory');
$translator->AddTranslation($lang, 'Forms.NumberfieldForm.Submit', 'Save');

$translator->AddTranslation($lang, 'Forms.NumberfieldForm.Name.Validation.Required.Missing', 'Name must be defined');
$translator->AddTranslation($lang, 'Forms.NumberfieldForm.Min.Validation.Number.NotParsed', 'Minimum must be an integer or floating point number');
$translator->AddTranslation($lang, 'Forms.NumberfieldForm.Max.Validation.Number.NotParsed', 'Maximum must be an integer or floating point number');
$translator->AddTranslation($lang, 'Forms.NumberfieldForm.Step.Validation.Number.NotParsed', 'Step size must be an integer or a floating point number');
$translator->AddTranslation($lang, 'Forms.NumberfieldForm.Step.Validation.Number.ExceedsMin_{0}', 'Step size must be positive or zero');